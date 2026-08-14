<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Course\Chapter\StoreRequest;
use App\Http\Requests\Admin\Course\Chapter\UpdateRequest;
use App\Services\Admin\Course\ChapterService;
use Illuminate\Http\JsonResponse;

class ChapterController extends Controller
{
    public function __construct(
        protected ChapterService $chapterService
    )
    {
        parent::__construct($chapterService, env('APP_VIEW_PATH_ADMIN').'.course.chapter');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->chapterService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->chapterService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
