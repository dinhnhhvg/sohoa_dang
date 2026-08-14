<?php

namespace App\Http\Controllers\Web\Admin\Config;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Config\Ethnicity\StoreRequest;
use App\Http\Requests\Admin\Config\Ethnicity\UpdateRequest;
use App\Services\Admin\Config\EthnicityService;
use Illuminate\Http\JsonResponse;

class EthnicityController extends Controller
{
    public function __construct(
        protected EthnicityService $ethnicityService
    )
    {
        parent::__construct($ethnicityService, env('APP_VIEW_PATH_ADMIN').'.config.ethnicity');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->ethnicityService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->ethnicityService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
