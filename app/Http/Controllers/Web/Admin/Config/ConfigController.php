<?php

namespace App\Http\Controllers\Web\Admin\Config;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Config\Config\StoreRequest;
use App\Http\Requests\Admin\Config\Config\UpdateRequest;
use App\Services\Admin\Config\ConfigService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function __construct(
        protected ConfigService $configService
    )
    {
        parent::__construct($configService, env('APP_VIEW_PATH_ADMIN') . '.config.config');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->configService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->configService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function storeImport(Request $request): JsonResponse
    {
        $data = $this->configService->storeImport($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }
}
