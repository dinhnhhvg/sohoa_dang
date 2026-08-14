<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\User\MenuRoleService;
use Illuminate\Http\JsonResponse;

class MenuRoleController extends Controller
{
    public function __construct(
        protected MenuRoleService $menuRoleService,
    )
    {
        parent::__construct($menuRoleService, env('APP_VIEW_PATH_ADMIN').'.user.menu_role');
    }

    public function toggleRelation(string|int $menuId, string|int $roleId): JsonResponse
    {
        if (!$this->menuRoleService->toggleRelation($menuId, $roleId)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
