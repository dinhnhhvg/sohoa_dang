<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Product\Product\StoreRequest;
use App\Http\Requests\Admin\Product\Product\UpdateRequest;
use App\Services\Admin\Product\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    )
    {
        parent::__construct($productService, env('APP_VIEW_PATH_ADMIN').'.product.product');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->productService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->productService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
