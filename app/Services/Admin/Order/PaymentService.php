<?php

namespace App\Services\Admin\Order;

use App\Exports\Admin\PaymentExport;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\StatusRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PaymentService extends BaseService
{
    public function __construct(
        protected PaymentRepository $paymentRepository,
        protected OrderRepository $orderRepository,
        protected StatusRepository $statusRepository,
        protected PaymentMethodRepository $paymentMethodRepository
    )
    {
        parent::__construct($paymentRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['paymentMethods'] = $this->paymentMethodRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('payment');
        return $data;
    }

    public function filterModal(Request $request): array
    {
        $data = $request->all();
        $data['order'] = $this->orderRepository->find($request->order_id);
        $data['paymentMethods'] = $this->paymentMethodRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('payment');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['payments'] = $this->paymentRepository->get($request->all());
        return $data;
    }


    public function create(Request $request): array
    {
        $order = $this->orderRepository->find($request->order_id, ['payments']);
        $finalAmount = $order->final_amount - $order->payments->sum('amount');

        $data = $request->all();
        $data['order'] = $order;
        $data['finalAmount'] = $finalAmount;
        $data['paymentMethods'] = $this->paymentMethodRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('payment');
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $order = $this->orderRepository->find($request->order_id, ['payments']);
        $finalAmount = $order->final_amount - $order->payments->sum('amount');
        $amount = formatPrice($request->input('amount'));
        $amount = min($amount, $finalAmount);
        if (!$amount) {
            return null;
        }
        $createData = [
            'order_id' => $request->input('order_id'),
            'name' => $request->input('name'),
            'payment_method_id' => $request->input('payment_method_id'),
            'content' => $request->input('content'),
            'amount' => $amount,
            'expiry_date' => $request->input('expiry_date') ? Carbon::parse($request->input('expiry_date'))->format('Y-m-d') : null,
            'sale_id' => session('user_id'),
            'status_id' => env('APP_PAYMENT_STATUS_PENDING_PAYMENT_ID'),
        ];
        return $this->paymentRepository->create($createData);
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['payment'] = $this->paymentRepository->find($id);
        $data['paymentMethods'] = $this->paymentMethodRepository->get();
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null {
        if ($request->input('status_id')) {
            $updateData = [
                'payment_time' => $request->input('payment_time') ? Carbon::parse($request->input('payment_time'))->format('Y-m-d H:i:s') : null,
                'note' => $request->input('note'),
                'image' => $request->input('image'),
                'status_id' => $request->input('status_id')
            ];
            $this->paymentRepository->update($id, $updateData);
            $payment = $this->paymentRepository->find($id);
            $payment->itemNotes()->create([
                'status_id' => $request->input('status_id'),
                'note' => $request->input('note'),
                'created_by_id' => session('user_id'),
                'created_by_type' => 'App\Models\User'
            ]);
            return true;
        }

        $order = $this->orderRepository->find($request->order_id, ['payments']);
        $finalAmount = $order->final_amount - $order->payments->where('id', '<>', $id)->sum('amount');
        $amount = formatPrice($request->input('amount'));
        $amount = min($amount, $finalAmount);
        if (!$amount) {
            return null;
        }

        $updateData = [
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'payment_method_id' => $request->input('payment_method_id'),
            'amount' => $amount,
            'expiry_date' => $request->input('expiry_date') ? Carbon::parse($request->input('expiry_date'))->format('Y-m-d') : null,
        ];
        return $this->paymentRepository->update($id, $updateData);
    }

    public function showNote(string|int $id, Request $request): array|null
    {
        $data = $request->all();
        $data['payment'] = $this->paymentRepository->find($id, ['itemNotes']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('payment');
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->paymentRepository->get($request->all());
        return Excel::download(new PaymentExport($data), 'payments.xlsx');
    }
}
