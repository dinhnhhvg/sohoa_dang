<?php

namespace App\Http\Controllers\Web\Admin\Config;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Config\Religion\StoreRequest;
use App\Http\Requests\Admin\Config\Religion\UpdateRequest;
use App\Services\Admin\Config\ReligionService;
use Illuminate\Http\JsonResponse;

class ReligionController extends Controller
{
    public function __construct(
        protected ReligionService $religionService
    )
    {
        parent::__construct($religionService, env('APP_VIEW_PATH_ADMIN').'.config.religion');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->religionService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->religionService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
