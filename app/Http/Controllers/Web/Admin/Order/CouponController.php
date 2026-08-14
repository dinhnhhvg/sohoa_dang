<?php

namespace App\Http\Controllers\Web\Admin\Order;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Order\Coupon\StoreRequest;
use App\Http\Requests\Admin\Order\Coupon\UpdateRequest;
use App\Services\Admin\Order\CouponService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(
        protected CouponService $couponService
    )
    {
        parent::__construct($couponService, env('APP_VIEW_PATH_ADMIN').'.order.coupon');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $this->couponService->store($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->couponService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function history(string|int $id, Request $request): string
    {
        $data = $this->couponService->history($id, $request);
        return view($this->viewPath.'.history.filter_modal', $data)->render();
    }

    public function historyFilter(string|int $id, Request $request): string
    {
        $data = $this->couponService->historyFilter($id, $request);
        return view($this->viewPath.'.history.filter', $data)->render();
    }
}
