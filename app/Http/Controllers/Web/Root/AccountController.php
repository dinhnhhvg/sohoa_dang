<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Root\Account\StoreRequest;
use App\Http\Requests\Root\Account\UpdateRequest;
use App\Services\Root\AccountService;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $accountService
    )
    {
        parent::__construct($accountService, env('APP_VIEW_PATH_ROOT').'.account');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->accountService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->accountService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
