<?php

namespace App\Http\Controllers\Web\Admin\Config;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Config\Nationality\StoreRequest;
use App\Http\Requests\Admin\Config\Nationality\UpdateRequest;
use App\Services\Admin\Config\NationalityService;
use Illuminate\Http\JsonResponse;

class NationalityController extends Controller
{
    public function __construct(
        protected NationalityService $nationalityService
    )
    {
        parent::__construct($nationalityService, env('APP_VIEW_PATH_ADMIN').'.config.nationality');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->nationalityService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->nationalityService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
