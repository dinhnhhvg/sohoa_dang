<?php

namespace App\Http\Controllers\Web\Admin\Order;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Order\Order\StoreRequest;
use App\Http\Requests\Admin\Order\Order\UpdateRequest;
use App\Services\Admin\Order\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    )
    {
        parent::__construct($orderService, env('APP_VIEW_PATH_ADMIN').'.order.order');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $this->orderService->store($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->orderService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function useCoupon(Request $request): JsonResponse
    {
        $data = $this->orderService->useCoupon($request);
        if (!$data['status']) {
            return $this->responseError($data['message']);
        }
        return $this->responseSuccess(__('app.message.update_success'), $data);
    }

    public function useDiscountAmount(Request $request): JsonResponse
    {
        $data = $this->orderService->useDiscountAmount($request);
        if (!$data['status']) {
            return $this->responseError($data['message']);
        }
        return $this->responseSuccess(__('app.message.update_success'), $data);
    }

    public function showNote(string|int $id, Request $request): string
    {
        $data = $this->orderService->showNote($id, $request);
        return view($this->viewPath.'.show_note', $data)->render();
    }
}
