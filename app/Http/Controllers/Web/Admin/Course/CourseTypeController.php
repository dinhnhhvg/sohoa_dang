<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Course\CourseType\StoreRequest;
use App\Http\Requests\Admin\Course\CourseType\UpdateRequest;
use App\Services\Admin\Course\CourseTypeService;
use Illuminate\Http\JsonResponse;

class CourseTypeController extends Controller
{
    public function __construct(
        protected CourseTypeService $courseTypeService
    )
    {
        parent::__construct($courseTypeService, env('APP_VIEW_PATH_ADMIN').'.course.course_type');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->courseTypeService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->courseTypeService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
