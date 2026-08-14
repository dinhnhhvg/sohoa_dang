<?php

namespace App\Services\Admin\Order;

use App\Exports\Admin\OrderExport;
use App\Models\User;
use App\Repositories\AgencyRepository;
use App\Repositories\CenterRepository;
use App\Repositories\ChannelRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CourseTypeRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerTagRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Services\Admin\Customer\CustomerService;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OrderService extends BaseService
{
    public function __construct(
        protected OrderRepository $orderRepository,
        protected TypeRepository $typeRepository,
        protected StatusRepository $statusRepository,
        protected AgencyRepository $agencyRepository,
        protected CustomerRepository $customerRepository,
        protected CouponRepository $couponRepository,
        protected CenterRepository $centerRepository,
        protected CustomerTagRepository $customerTagRepository,
        protected ProvinceRepository $provinceRepository,
        protected CourseTypeRepository $courseTypeRepository,
        protected ChannelRepository $channelRepository,
        protected ProductRepository $productRepository,

        protected CustomerService $customerService
    )
    {
        parent::__construct($orderRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('order');
        $data['statuses'] = $this->typeRepository->getActiveByModule('status');
        $data['agencies'] = $this->agencyRepository->get();
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['orders'] = $this->orderRepository->get($request->all, ['customer', 'orderItems', 'payments']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('order');
        $data['statuses'] = $this->typeRepository->getActiveByModule('status');
        $data['agencies'] = $this->agencyRepository->get();
        $data['centers'] = $this->centerRepository->get();
        $data['customerTags'] = $this->customerTagRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        if ($request->input('type_id') == env('APP_DEFAULT_TYPE_COURSE')) {
            $data['courseTypes'] = $this->courseTypeRepository->get(['is_active' => 1], ['course', 'type']);
        }
        if ($request->input('type_id') == env('APP_DEFAULT_TYPE_PRODUCT')) {
            $data['products'] = $this->productRepository->get(['is_active' => 1], ['values']);
        }
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $customer = $this->customerRepository->findByPhoneAndName($request->all());
        if (!$customer) {
            $customer = $this->customerService->store($request);
        } else {
            $this->customerService->update($customer->id, $request);
        }
        return $this->storeByCustomer($customer->id, $request);
    }

    public function storeByCustomer(string|int $customerId, Request $request): Model|array|null
    {
        $totalAmount = 0;
        if ($request->price) {
            foreach ($request->price as $price) {
                $totalAmount += formatPrice($price);
            }
        }

        $checkCoupon = $this->checkCoupon($request->coupon_code, $totalAmount);
        $checkDiscountAmount = $this->checkDiscountAmount($request->discount_amount, $totalAmount - ($checkCoupon['amount'] ?? 0));

        $createData = [
            'customer_id' => $customerId,
            'contact_id' => $request->input('contact_id'),
            'content' => $request->input('content'),
            'status_id' => env('APP_DEFAULT_ORDER_STATUS_ID'),
            'note' => $request->note,
            'type_id' => $request->type_id,
            'total_amount' => $totalAmount,
            'discount_amount' => $checkDiscountAmount['discount_amount'] ?? 0,
            'coupon_id' => $checkCoupon['id'] ?? null,
            'coupon_amount' => $checkCoupon['amount'] ?? 0
        ];
        $order = $this->orderRepository->create($createData);

        $order->itemNotes()->create([
            'status_id' => env('APP_DEFAULT_CONTACT_STATUS_ID'),
            'note' => $request->note,
            'channel_id' => $request->channel_id,
            'created_by_id' => session('user_id'),
            'created_by_type' => User::class
        ]);

        if ($request->type_id == 1 && $request->course_type_id) {
            foreach ($request->course_type_id as $i => $courseTypeId) {
                $createItemData = [
                    'item_type' => 'App\Models\CourseType',
                    'item_id' => $courseTypeId,
                    'price' => formatPrice($request->price[$i]),
                    'content' => $request->item_content[$i]
                ];
                $order->orderItems()->create($createItemData);
            }
        }
        return [
            'status' => true,
            'order' => $order
        ];
    }

    public function showNote(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['order'] = $this->orderRepository->find($id, ['itemNotes']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('order');
        $data['channels'] = $this->channelRepository->get();
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $order = $this->orderRepository->find($id, ['customer']);
        if ($request->input('status_id')) {
            if ($order->customer->channel_id != $request->input('channel_id')) {
                $customerDataUpdate = ['channel_id' => $request->channel_id];
                $this->customerRepository->update($order->customer_id, $customerDataUpdate);
            }
            $order->itemNotes()->create([
                'status_id' => $request->input('status_id'),
                'note' => $request->input('note'),
                'channel_id' => $request->input('channel_id'),
                'created_by_id' => session('user_id'),
                'created_by_type' => User::class
            ]);
            $updateData = [
                'status_id' => $request->input('status_id'),
                'note' => $request->input('note')
            ];
            return $this->orderRepository->update($id, $updateData);
        }

        $order = $this->orderRepository->find($id);
        $checkCoupon = $this->checkCoupon($request->input('coupon_code'), $order->total_amount, $order->coupon_id);
        $checkDiscountAmount = $this->checkDiscountAmount($request->input('discount_amount'), $order->total_amount - ($checkCoupon['amount'] ?? 0));
        $updateData = [
            'content' => $request->input('content'),
            'discount_amount' => $checkDiscountAmount['discount_amount'] ?? 0,
            'coupon_id' => $checkCoupon['id'] ?? null,
            'coupon_amount' => $checkCoupon['amount'] ?? 0
        ];
        return $this->orderRepository->update($id, $updateData);
    }

    public function updateAmount(string|int $id): void
    {
        $order = $this->orderRepository->find($id, ['orderItems']);
        $totalAmount = 0;
        foreach ($order->orderItems as $orderItem) {
            $totalAmount += $orderItem->price * $orderItem->quantity;
        }
        $checkCoupon = $this->checkCoupon($order->coupon, $totalAmount, $order->coupon_id);
        $checkDiscountAmount = $this->checkDiscountAmount($order->discount_amount, $totalAmount - ($checkCoupon['amount'] ?? 0));
        $updateData = [
            'total_amount' => $totalAmount,
            'discount_amount' => $checkDiscountAmount['discount_amount'] ?? 0,
            'coupon_id' => $checkCoupon['id'] ?? null,
            'coupon_amount' => $checkCoupon['amount'] ?? 0
        ];
        $this->orderRepository->update($id, $updateData);
    }

    public function useCoupon(Request $request): array
    {
        return $this->checkCoupon($request->coupon_code, $request->total_amount);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->orderRepository->get($request->all());
        return Excel::download(new OrderExport($data), 'orders.xlsx');
    }

    private function checkCoupon(?string $couponCode, ?int $totalAmount, string|int|null $couponId = null): array
    {
        if (!$couponCode) {
            return [
                'status' => false,
                'amount' => 0,
            ];
        }

        $coupon = $this->couponRepository->findByCode($couponCode, [], ['orders']);
        if (!$coupon) {
            return [
                'status' => false,
                'amount' => 0,
                'message' => __('app.message.no_information_found', ['name' => __('app.coupon')])
            ];
        }

        if ($coupon->id != $couponId) {
            if ($coupon->limit && $coupon->limit == $coupon->orders_count) {
                return [
                    'status' => false,
                    'amount' => 0,
                    'message' => __('app.message.the_name_has_been_used_up', ['name' => __('app.coupon')])
                ];
            }
            if (($coupon->start_date && $coupon->start_date->toDateString() > today()->toDateString()) || ($coupon->end_date && $coupon->end_date->toDateString() < today()->toDateString())) {
                return [
                    'status' => false,
                    'amount' => 0,
                    'message' => __('app.message.the_name_has_expired', ['name' => __('app.coupon')])
                ];
            }
            if (($coupon->min_amount && $coupon->min_amount > $totalAmount) || ($coupon->max_amount && $coupon->max_amount < $totalAmount)) {
                return [
                    'status' => false,
                    'amount' => 0,
                    'message' => __('app.message.the_name_is_not_eligible_for_use', ['name' => __('app.order')])
                ];
            }
        }

        if ($coupon->type !== 'amount') {
            $amount = round($totalAmount * $coupon->value / 100);
        } else {
            $amount = min($coupon->value, $totalAmount);
        }

        return [
            'status' => true,
            'id' => $coupon->id,
            'amount' => $amount,
        ];
    }

    public function useDiscountAmount(Request $request): array
    {
        return $this->checkDiscountAmount($request->discount_amount, $request->amount);
    }

    private function checkDiscountAmount(?string $discountAmount, ?int $amount): array
    {
        if (!$discountAmount) {
            return [
                'status' => false,
                'amount' => 0
            ];
        }

        return [
            'status' => true,
            'discount_amount' => min(formatPrice($discountAmount), $amount)
        ];
    }
}
