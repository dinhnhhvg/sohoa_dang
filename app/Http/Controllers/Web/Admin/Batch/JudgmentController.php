<?php

namespace App\Http\Controllers\Web\Admin\Batch;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Batch\Judgment\ReportFilterRequest;
use App\Http\Requests\Admin\Batch\Judgment\StoreRequest;
use App\Http\Requests\Admin\Batch\Judgment\UpdateRequest;
use App\Services\Admin\Batch\JudgmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JudgmentController extends Controller
{
    public function __construct(
        protected JudgmentService $judgmentService
    )
    {
        parent::__construct($judgmentService, env('APP_VIEW_PATH_ADMIN').'.batch.judgment');
    }

    public function filterCard(Request $request): string
    {
        $data = $this->judgmentService->filterCard($request);
        return view($this->viewPath.'.filter_card', $data)->render();
    }

    public function updateHvg(Request $request): string
    {
        $this->judgmentService->updateHvg($request);
        return '';
    }

    public function filter(Request $request): string
    {
        $data = $this->judgmentService->filter($request);
        return view($this->viewPath.'.filter', $data)->render();
    }

    public function entry(string|int $id, Request $request): View
    {
        $data = $this->judgmentService->entry($id, $request);
        return view($this->viewPath.'.entry', $data);
    }

    public function check(string|int $id, Request $request): View
    {
        $data = $this->judgmentService->check($id, $request);
        return view($this->viewPath.'.check', $data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->judgmentService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->judgmentService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function showNote(string|int $id, Request $request): string
    {
        $data = $this->judgmentService->showNote($id, $request);
        return view($this->viewPath.'.show_note', $data)->render();
    }

    public function reportCard(Request $request): string
    {
        $data = $this->judgmentService->reportCard($request);
        return view($this->viewPath.'.report_card', $data)->render();
    }

    public function reportFilter(ReportFilterRequest $request): string
    {
        $data = $this->judgmentService->reportFilter($request);
        return view($this->viewPath.'.report_filter', $data)->render();
    }

    public function destroyManyEntry(Request $request): JsonResponse
    {
        if (!$this->judgmentService->destroyManyEntry($request)) {
            return $this->responseError(__('app.message.destroy_error'));
        }
        return $this->responseSuccess(__('app.message.destroy_success'));
    }

    public function destroyManyChecker(Request $request): JsonResponse
    {
        if (!$this->judgmentService->destroyManyChecker($request)) {
            return $this->responseError(__('app.message.destroy_error'));
        }
        return $this->responseSuccess(__('app.message.destroy_success'));
    }

    public function showWorkDistribution(Request $request): string
    {
        $data = $this->judgmentService->showWorkDistribution($request);
        return view($this->viewPath.'.show_work_distribution', $data)->render();
    }

    public function workDistribution(Request $request): JsonResponse
    {
        if (!$this->judgmentService->workDistribution($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }
}
