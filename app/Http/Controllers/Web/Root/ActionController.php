<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Action\StoreRequest;
use App\Http\Requests\Root\Action\UpdateRequest;
use App\Services\Root\ActionService;
use Illuminate\Http\JsonResponse;

class ActionController extends Controller
{
    public function __construct(
        protected ActionService $actionService
    )
    {
        parent::__construct($actionService, env('APP_VIEW_PATH_ROOT').'.action');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->actionService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->actionService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
