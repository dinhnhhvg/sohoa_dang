<?php

namespace App\Http\Controllers\Web\Admin\Batch;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Batch\JudgmentDocument\UpdateRequest;
use App\Services\Admin\Batch\JudgmentDocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JudgmentDocumentController extends Controller
{
    public function __construct(
        protected JudgmentDocumentService $judgmentDocumentService
    )
    {
        parent::__construct($judgmentDocumentService, env('APP_VIEW_PATH_ADMIN') . '.batch.judgment_document');
    }

    public function filter(Request $request): string
    {
        $data = $this->judgmentDocumentService->filter($request);
        return view($this->viewPath . '.' . $data['view'] . '.filter', $data)->render();
    }

    public function editByFilePath(Request $request): View
    {
        $data = $this->judgmentDocumentService->editByFilePath($request);
        return view($this->viewPath . '.edit_by_file_path', $data);
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->judgmentDocumentService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function showNote(string|int $id, Request $request): string
    {
        $data = $this->judgmentDocumentService->showNote($id, $request);
        return view($this->viewPath . '.show_note', $data)->render();
    }

    public function updatePdf2(Request $request): JsonResponse
    {
        return $this->responseSuccess(__('app.progressing'));
    }

    public function showCopyDefendant(int|string $id, Request $request): string
    {
        $data = $this->judgmentDocumentService->showCopyDefendant($id, $request);
        return view($this->viewPath . '.show_copy_defendant', $data)->render();
    }

    public function copyDefendant(int|string $id, Request $request): JsonResponse
    {
        if (!$this->judgmentDocumentService->copyDefendant($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
