<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\Setting\UpdateRequest;
use App\Services\Admin\Setting\SettingService;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    )
    {
        parent::__construct($settingService, env('APP_VIEW_PATH_ADMIN').'.setting.setting');
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        if (!$this->settingService->updateConfig($request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
