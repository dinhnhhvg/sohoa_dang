<?php

namespace App\Http\Controllers\Web\Admin\Address;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Address\Province\StoreRequest;
use App\Http\Requests\Admin\Address\Province\UpdateRequest;
use App\Services\Admin\Address\ProvinceService;
use Illuminate\Http\JsonResponse;

class ProvinceController extends Controller
{
    public function __construct(
        protected ProvinceService $provinceService
    )
    {
        parent::__construct($provinceService, env('APP_VIEW_PATH_ADMIN').'.address.province');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->provinceService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->provinceService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
