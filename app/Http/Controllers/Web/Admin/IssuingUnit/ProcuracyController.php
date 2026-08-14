<?php

namespace App\Http\Controllers\Web\Admin\IssuingUnit;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\IssuingUnit\Procuracy\StoreRequest;
use App\Http\Requests\Admin\IssuingUnit\Procuracy\UpdateRequest;
use App\Services\Admin\IssuingUnit\ProcuracyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProcuracyController extends Controller
{
    public function __construct(
        protected ProcuracyService $procuracyService
    )
    {
        parent::__construct($procuracyService, env('APP_VIEW_PATH_ADMIN').'.issuing_unit.procuracy');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->procuracyService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->procuracyService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function storeImport(Request $request): JsonResponse
    {
        $data = $this->procuracyService->storeImport($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }
}
