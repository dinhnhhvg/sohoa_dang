<?php

namespace App\Http\Controllers\Web\Admin\Class;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Class\Lesson\StoreRequest;
use App\Http\Requests\Admin\Class\Lesson\UpdateRequest;
use App\Services\Admin\Class\LessonService;
use Illuminate\Http\JsonResponse;

class LessonController extends Controller
{
    public function __construct(
        protected LessonService $lessonService
    )
    {
        parent::__construct($lessonService, env('APP_VIEW_PATH_ADMIN').'.class.lesson');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->lessonService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->lessonService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
