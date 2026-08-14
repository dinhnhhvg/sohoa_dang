<?php

namespace App\Http\Controllers\Web\Admin\Order;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Order\Payment\StoreRequest;
use App\Http\Requests\Admin\Order\Payment\UpdateRequest;
use App\Services\Admin\Order\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService
    )
    {
        parent::__construct($paymentService, env('APP_VIEW_PATH_ADMIN').'.order.payment');
    }

    public function filterModal(Request $request): string
    {
        $data = $this->service->filterModal($request);
        return view($this->viewPath.'.filter_modal', $data)->render();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->paymentService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->paymentService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function showNote(string|int $id, Request $request): string
    {
        $data = $this->paymentService->showNote($id, $request);
        return view($this->viewPath.'.show_note', $data)->render();
    }


}
