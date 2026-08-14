<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Type\StoreRequest;
use App\Http\Requests\Root\Type\UpdateRequest;
use App\Services\Root\TypeService;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{
    public function __construct(
        protected TypeService $typeService
    )
    {
        parent::__construct($typeService, env('APP_VIEW_PATH_ROOT').'.type');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->typeService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->typeService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
