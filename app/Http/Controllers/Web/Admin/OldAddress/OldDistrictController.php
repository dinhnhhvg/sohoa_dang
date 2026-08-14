<?php

namespace App\Http\Controllers\Web\Admin\OldAddress;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\OldAddress\OldWard\StoreRequest;
use App\Http\Requests\Admin\OldAddress\OldWard\UpdateRequest;
use App\Services\Admin\OldAddress\OldDistrictService;
use Illuminate\Http\JsonResponse;

class OldDistrictController extends Controller
{
    public function __construct(
        protected OldDistrictService $oldDistrictService
    )
    {
        parent::__construct($oldDistrictService, env('APP_VIEW_PATH_ADMIN').'.old_address.old_district');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->oldDistrictService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->oldDistrictService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
