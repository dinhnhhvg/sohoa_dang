<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\AlohubExtension\StoreRequest;
use App\Http\Requests\Admin\Setting\AlohubExtension\UpdateRequest;
use App\Services\Admin\Setting\AlohubExtensionService;
use Illuminate\Http\JsonResponse;

class AlohubExtensionController extends Controller
{
    public function __construct(
        protected AlohubExtensionService $alohubExtensionService
    )
    {
        parent::__construct($alohubExtensionService, env('APP_VIEW_PATH_ADMIN') . '.setting.alohub_extension');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->alohubExtensionService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->alohubExtensionService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
