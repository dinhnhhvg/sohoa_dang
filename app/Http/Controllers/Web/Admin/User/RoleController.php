<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\User\Role\StoreRequest;
use App\Http\Requests\Admin\User\Role\UpdateRequest;
use App\Services\Admin\User\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService $roleService
    )
    {
        parent::__construct($roleService, env('APP_VIEW_PATH_ADMIN').'.user.role');
    }

    public function permission(int|string $id): View
    {
        $data = $this->roleService->permission($id);
        return view($this->viewPath.'.permission.index', $data);
    }

    public function filterPermission(Request $request): View
    {
        $data = $this->roleService->filterPermission($request);
        return view($this->viewPath.'.permission.filter', $data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->roleService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->roleService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
