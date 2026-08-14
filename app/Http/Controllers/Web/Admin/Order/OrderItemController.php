<?php

namespace App\Http\Controllers\Web\Admin\Order;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Order\OrderItem\StoreRequest;
use App\Http\Requests\Admin\Order\OrderItem\UpdateRequest;
use App\Services\Admin\Order\OrderItemService;
use Illuminate\Http\JsonResponse;

class OrderItemController extends Controller
{
    public function __construct(
        protected OrderItemService $orderItemService,
    )
    {
        parent::__construct($orderItemService, env('APP_VIEW_PATH_ADMIN').'.order.order_item');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->orderItemService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->orderItemService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
