<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\User\User\StoreImportRequest;
use App\Http\Requests\Admin\User\User\StoreRequest;
use App\Http\Requests\Admin\User\User\UpdateRequest;
use App\Services\Admin\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
        parent::__construct($userService, env('APP_VIEW_PATH_ADMIN').'.user.user');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->userService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function storeImport(StoreImportRequest $request): JsonResponse
    {
        $data = $this->userService->storeImport($request);
        return $this->responseSuccess(__('app.message.create_success'), $data);
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->userService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function getNoteValue(string|int $id, Request $request): ?string
    {
        return $this->userService->show($id, $request)['user']->note_value;
    }

    public function createCampaignCustomer(Request $request): string
    {
        $data = $this->userService->createCampaignCustomer($request);
        return view($this->viewPath.'.create_campaign_customer', $data);
    }

    public function info(Request $request): JsonResponse
    {
        $data = $this->userService->info($request);
        return $this->responseSuccess('', $data);
    }
}
