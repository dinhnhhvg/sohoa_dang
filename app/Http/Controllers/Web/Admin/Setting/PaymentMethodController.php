<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\PaymentMethod\StoreRequest;
use App\Http\Requests\Admin\Setting\PaymentMethod\UpdateRequest;
use App\Services\Admin\Setting\PaymentMethodService;
use Illuminate\Http\JsonResponse;

class PaymentMethodController extends Controller
{
    public function __construct(
        protected PaymentMethodService $paymentMethodService
    )
    {
        parent::__construct($paymentMethodService, env('APP_VIEW_PATH_ADMIN').'.setting.payment_method');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->paymentMethodService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->paymentMethodService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
