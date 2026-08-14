<?php

namespace App\Http\Controllers\Web\Admin\Address;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Address\Ward\StoreRequest;
use App\Http\Requests\Admin\Address\Ward\UpdateRequest;
use App\Services\Admin\Address\WardService;
use Illuminate\Http\JsonResponse;

class WardController extends Controller
{
    public function __construct(
        protected WardService $wardService
    )
    {
        parent::__construct($wardService, env('APP_VIEW_PATH_ADMIN').'.address.ward');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->wardService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->wardService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
