<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Course\ChapterVideo\StoreRequest;
use App\Http\Requests\Admin\Course\ChapterVideo\UpdateRequest;
use App\Services\Admin\Course\ChapterVideoService;
use Illuminate\Http\JsonResponse;

class ChapterVideoController extends Controller
{
    public function __construct(
        protected ChapterVideoService $chapterVideoService
    )
    {
        parent::__construct($chapterVideoService, env('APP_VIEW_PATH_ADMIN').'.course.chapter_video');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->chapterVideoService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->chapterVideoService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
