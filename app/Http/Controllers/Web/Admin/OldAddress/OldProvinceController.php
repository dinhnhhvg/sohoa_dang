<?php

namespace App\Http\Controllers\Web\Admin\OldAddress;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\OldAddress\OldProvince\StoreRequest;
use App\Http\Requests\Admin\OldAddress\OldProvince\UpdateRequest;
use App\Services\Admin\OldAddress\OldProvinceService;
use Illuminate\Http\JsonResponse;

class OldProvinceController extends Controller
{
    public function __construct(
        protected OldProvinceService $oldProvinceService
    )
    {
        parent::__construct($oldProvinceService, env('APP_VIEW_PATH_ADMIN').'.old_address.old_province');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->oldProvinceService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->oldProvinceService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
