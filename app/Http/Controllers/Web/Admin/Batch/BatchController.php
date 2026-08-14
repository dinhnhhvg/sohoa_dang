<?php

namespace App\Http\Controllers\Web\Admin\Batch;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Batch\Batch\StoreRequest;
use App\Http\Requests\Admin\Batch\Batch\UpdateRequest;
use App\Http\Requests\Admin\Batch\Judgment\ReportFilterRequest;
use App\Services\Admin\Batch\BatchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BatchController extends Controller
{
    public function __construct(
        protected BatchService $batchService
    )
    {
        parent::__construct($batchService, env('APP_VIEW_PATH_ADMIN').'.batch.batch');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->batchService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->batchService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function reportCard(string|int $id, Request $request): string
    {
        $data = $this->batchService->reportCard($id, $request);
        return view($this->viewPath.'.report.report_card', $data)->render();
    }

    public function reportEntry(ReportFilterRequest $request): string
    {
        $data = $this->batchService->reportEntry($request);
        return view($this->viewPath.'.report.report_entry', $data)->render();
    }

    public function reportCheck(ReportFilterRequest $request): string
    {
        $data = $this->batchService->reportCheck($request);
        return view($this->viewPath.'.report.report_check', $data)->render();
    }

    public function reportDateCard(string|int $id, Request $request): string
    {
        $data = $this->batchService->reportCard($id, $request);
        return view($this->viewPath.'.report_date.report_card', $data)->render();
    }

    public function reportDateFilter(ReportFilterRequest $request): string
    {
        $data = $this->batchService->reportDateFilter($request);
        return view($this->viewPath.'.report_date.report_filter', $data)->render();
    }

    public function exportDetail(string|int $id, Request $request): BinaryFileResponse
    {
        return $this->batchService->exportDetail($id, $request);
    }

    public function reportUser(Request $request): View
    {
        $data = $this->batchService->reportUser($request);
        return view($this->viewPath.'.report_user.index', $data);
    }

    public function reportUserFilter(Request $request): string
    {
        $data = $this->batchService->reportUserFilter($request);
        return view($this->viewPath.'.report_user.filter', $data)->render();
    }
}
