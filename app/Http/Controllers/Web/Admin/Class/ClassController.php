<?php

namespace App\Http\Controllers\Web\Admin\Class;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Class\Class\StoreRequest;
use App\Http\Requests\Admin\Class\Class\UpdateRequest;
use App\Services\Admin\Class\ClassService;
use Illuminate\Http\JsonResponse;

class ClassController extends Controller
{
    public function __construct(
        protected ClassService $classService
    )
    {
        parent::__construct($classService, env('APP_VIEW_PATH_ADMIN').'.class.class');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->classService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->classService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
