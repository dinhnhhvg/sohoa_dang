<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Course\Course\StoreRequest;
use App\Http\Requests\Admin\Course\Course\UpdateRequest;
use App\Services\Admin\Course\CourseService;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    )
    {
        parent::__construct($this->courseService, env('APP_VIEW_PATH_ADMIN').'.course.course');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->courseService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->courseService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
