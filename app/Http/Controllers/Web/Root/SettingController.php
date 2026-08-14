<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Setting\UpdateRequest;
use App\Services\Root\SettingService;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    )
    {
        parent::__construct($settingService, env('APP_VIEW_PATH_ROOT').'.setting.setting');
    }

    public function updateByKey(UpdateRequest $request): JsonResponse
    {
        if (!$this->settingService->updateByKey($request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
