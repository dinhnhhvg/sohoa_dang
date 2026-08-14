<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\User\RoleMenuActionService;
use Illuminate\Http\JsonResponse;

class RoleMenuActionController extends Controller
{
    public function __construct(
        protected RoleMenuActionService $roleMenuActionService
    )
    {
        parent::__construct($roleMenuActionService, env('APP_VIEW_PATH_ADMIN').'user.role_menu_action');
    }

    public function toggleRelation(string|int $roleId, string|int $menuActionId): JsonResponse
    {
        if (!$this->roleMenuActionService->toggleRelation($roleId, $menuActionId)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
