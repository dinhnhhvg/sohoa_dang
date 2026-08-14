<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\CustomerTag\StoreRequest;
use App\Http\Requests\Admin\Setting\CustomerTag\UpdateRequest;
use App\Services\Admin\Setting\CustomerTagService;
use Illuminate\Http\JsonResponse;

class CustomerTagController extends Controller
{
    public function __construct(
        protected CustomerTagService $customerTagService
    )
    {
        parent::__construct($customerTagService, env('APP_VIEW_PATH_ADMIN').'.setting.customer_tag');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->customerTagService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->customerTagService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
