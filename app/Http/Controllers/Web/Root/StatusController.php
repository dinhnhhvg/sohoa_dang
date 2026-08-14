<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Status\StoreRequest;
use App\Http\Requests\Root\Status\UpdateRequest;
use App\Services\Root\StatusService;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    public function __construct(
        protected StatusService $statusService
    )
    {
        parent::__construct($statusService, env('APP_VIEW_PATH_ROOT').'.status');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->statusService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->statusService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
