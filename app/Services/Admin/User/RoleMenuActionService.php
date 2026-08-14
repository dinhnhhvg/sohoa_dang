<?php

namespace App\Services\Admin\User;

use App\Repositories\RoleMenuActionRepository;
use App\Services\BaseService;

class RoleMenuActionService extends BaseService
{
    public function __construct(
        protected RoleMenuActionRepository $roleMenuActionRepository,
    )
    {
        parent::__construct($roleMenuActionRepository);
    }

    public function toggleRelation(string|int $roleId, string|int $menuActionId): bool
    {
        $check = $this->roleMenuActionRepository->getByRoleAndMenuAction($roleId, $menuActionId);
        if ($check) {
            return $this->roleMenuActionRepository->deleteByRoleAndMenuAction($roleId, $menuActionId);
        }
        $createData = [
            'role_id' => $roleId,
            'menu_action_id' => $menuActionId
        ];
        $this->roleMenuActionRepository->create($createData);
        return true;
    }
}
