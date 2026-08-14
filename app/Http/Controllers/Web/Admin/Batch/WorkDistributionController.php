<?php

namespace App\Http\Controllers\Web\Admin\Batch;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\Batch\WorkDistributionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkDistributionController extends Controller
{
    public function __construct(
        protected WorkDistributionService $workDistributionService
    )
    {
        parent::__construct($workDistributionService, env('APP_VIEW_PATH_ADMIN').'.batch.work_distribution');
    }

    public function handle(string|int $id, Request $request): JsonResponse
    {
        $data = $this->workDistributionService->handle($id, $request);
        if (!$data['status']) {
            return $this->responseError($data['message']);
        }
        return $this->responseSuccess(__('app.message.update_success'), $data);
    }
}
