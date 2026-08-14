<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Category\Category\StoreRequest;
use App\Http\Requests\Admin\Category\Category\UpdateRequest;
use App\Services\Admin\Category\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    )
    {
        parent::__construct($this->categoryService, env('APP_VIEW_PATH_ADMIN').'.category.category');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->categoryService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->categoryService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
