<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Agency\StoreRequest;
use App\Http\Requests\Admin\Agency\UpdateRequest;
use App\Services\Admin\AgencyService;
use Illuminate\Http\JsonResponse;

class AgencyController extends Controller
{
    public function __construct(
        protected AgencyService $agencyService
    )
    {
        parent::__construct($agencyService, env('APP_VIEW_PATH_ADMIN').'.agency');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->agencyService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->agencyService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
