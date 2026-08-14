<?php

namespace App\Http\Controllers\Web\Admin\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Course\ChapterDocument\StoreRequest;
use App\Http\Requests\Admin\Course\ChapterDocument\UpdateRequest;
use App\Services\Admin\Course\ChapterDocumentService;
use Illuminate\Http\JsonResponse;

class ChapterDocumentController extends Controller
{
    public function __construct(
        protected ChapterDocumentService $chapterDocumentService
    )
    {
        parent::__construct($chapterDocumentService, env('APP_VIEW_PATH_ADMIN').'.course.chapter_document');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->chapterDocumentService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->chapterDocumentService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
