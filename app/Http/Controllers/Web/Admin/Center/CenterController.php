<?php

namespace App\Http\Controllers\Web\Admin\Center;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Center\Center\StoreRequest;
use App\Http\Requests\Admin\Center\Center\UpdateRequest;
use App\Services\Admin\Center\CenterService;
use Illuminate\Http\JsonResponse;

class CenterController extends Controller
{
    public function __construct(
        protected CenterService $centerService
    )
    {
        parent::__construct($centerService, env('APP_VIEW_PATH_ADMIN').'.center.center');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->centerService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->centerService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
