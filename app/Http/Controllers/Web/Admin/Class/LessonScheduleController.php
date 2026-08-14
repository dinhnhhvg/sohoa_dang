<?php

namespace App\Http\Controllers\Web\Admin\Class;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Class\LessonSchedule\StoreLessonRequest;
use App\Http\Requests\Admin\Class\LessonSchedule\StoreRequest;
use App\Http\Requests\Admin\Class\LessonSchedule\UpdateRequest;
use App\Services\Admin\Class\LessonScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonScheduleController extends Controller
{
    public function __construct(
        protected LessonScheduleService $lessonScheduleService
    )
    {
        parent::__construct($lessonScheduleService, env('APP_VIEW_PATH_ADMIN') . '.class.lesson_schedule');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->lessonScheduleService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function createLesson(Request $request): string
    {
        $data = $this->service->createLesson($request);
        return view($this->viewPath.'.create_lesson', $data)->render();
    }

    public function expectedSchedule(StoreLessonRequest $request): JsonResponse
    {
        $data = $this->lessonScheduleService->expectedSchedule($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function storeLesson(StoreLessonRequest $request): JsonResponse
    {
        $data = $this->lessonScheduleService->storeLesson($request);
        return $this->responseSuccess(__('app.message.please_check_the_results'), $data);
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->lessonScheduleService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
