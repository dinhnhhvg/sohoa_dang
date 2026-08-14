<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Product\AttributeValue\StoreRequest;
use App\Http\Requests\Admin\Product\AttributeValue\UpdateRequest;
use App\Services\Admin\Product\AttributeValueService;
use Illuminate\Http\JsonResponse;

class AttributeValueController extends Controller
{
    public function __construct(
        protected AttributeValueService $attributeValueService
    )
    {
        parent::__construct($attributeValueService, env('APP_VIEW_PATH_ADMIN').'.product.attribute_value');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->attributeValueService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->attributeValueService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
