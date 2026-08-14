<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Product\Attribute\StoreRequest;
use App\Http\Requests\Admin\Product\Attribute\UpdateRequest;
use App\Services\Admin\Product\AttributeService;
use Illuminate\Http\JsonResponse;

class AttributeController extends Controller
{
    public function __construct(
        protected AttributeService $attributeService
    )
    {
        parent::__construct($attributeService, env('APP_VIEW_PATH_ADMIN').'.product.attribute');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->attributeService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->attributeService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
