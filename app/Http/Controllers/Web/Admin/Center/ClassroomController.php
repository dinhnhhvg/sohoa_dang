<?php

namespace App\Http\Controllers\Web\Admin\Center;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Center\Classroom\StoreRequest;
use App\Http\Requests\Admin\Center\Classroom\UpdateRequest;
use App\Services\Admin\Center\ClassroomService;
use Illuminate\Http\JsonResponse;

class ClassroomController extends Controller
{
    public function __construct(
        protected ClassroomService $classroomService
    )
    {
        parent::__construct($classroomService, env('APP_VIEW_PATH_ADMIN').'.center.classroom');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->classroomService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->classroomService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
