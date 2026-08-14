<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\OldAgency\StoreRequest;
use App\Http\Requests\Admin\OldAgency\UpdateRequest;
use App\Services\Admin\OldAgencyService;
use Illuminate\Http\JsonResponse;

class OldAgencyController extends Controller
{
    public function __construct(
        protected OldAgencyService $oldAgencyService
    )
    {
        parent::__construct($oldAgencyService, env('APP_VIEW_PATH_ADMIN').'.old_agency');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->oldAgencyService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->oldAgencyService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
