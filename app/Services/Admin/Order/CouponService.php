<?php

namespace App\Services\Admin\Order;

use App\Exports\Admin\CouponExport;
use App\Repositories\CouponRepository;
use App\Repositories\OrderRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CouponService extends BaseService
{
    public function __construct(
        protected CouponRepository $couponRepository,
        protected OrderRepository $orderRepository
    )
    {
        parent::__construct($couponRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['coupons'] = $this->couponRepository->get($request->all, [], ['orders']);
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData = $this->handleData($createData);
        $createData['is_active'] = 1;
        unset($createData['quantity']);
        $quantity = $request->quantity;

        for ($i = 1; $i <= $quantity; $i++) {
            $createData['code'] = Str::upper(Str::random(10));
            $this->couponRepository->create($createData);
        }
        return ['status' => true];
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $dataUpdate = $request->validated();
        $dataUpdate = $this->handleData($dataUpdate);
        return $this->couponRepository->update($id, $dataUpdate);
    }

    private function handleData(?array $data): ?array
    {
        if (isset($data['value']) && $data['value']) {
            $data['value'] = formatPrice($data['value']);
        }
        if (isset($data['min_amount']) && $data['min_amount']) {
            $data['min_amount'] = formatPrice($data['min_amount']);
        }
        if (isset($data['max_amount']) && $data['max_amount']) {
            $data['max_amount'] = formatPrice($data['max_amount']);
        }
        if (isset($data['start_date']) && $data['start_date']) {
            $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        }
        if (isset($data['end_date']) && $data['end_date']) {
            $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
        }

        if (isset($data['type']) && $data['type'] === 'amount' && $data['max_amount'] && $data['value'] > $data['max_amount']) {
            $data['value'] = 1;
        }
        if (isset($data['type']) && $data['type'] === 'percent' && $data['value'] >= 100) {
            $data['value'] = 1;
        }
        return $data;
    }

    public function history(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['coupon_id'] = $id;
        return $data;
    }

    public function historyFilter(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['id'] = $id;
        $data['orders'] = $this->orderRepository->get($request->all(), ['customer']);
        return $data;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->couponRepository->get($request->all());
        return Excel::download(new CouponExport($data), 'coupons.xlsx');
    }
}
