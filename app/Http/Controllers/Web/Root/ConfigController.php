<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Config\UpdateRequest;
use App\Services\Root\ConfigService;
use Illuminate\Http\JsonResponse;

class ConfigController extends Controller
{
    public function __construct(
        protected ConfigService $configService
    )
    {
        parent::__construct($configService, env('APP_VIEW_PATH_ROOT').'.config');
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        if (!$this->configService->updateConfig($request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
