<?php

namespace App\Services\Admin\User;

use App\Repositories\MenuRoleRepository;
use App\Services\BaseService;

class MenuRoleService extends BaseService
{
    public function __construct(
        protected MenuRoleRepository $menuRoleRepository,
    )
    {
        parent::__construct($menuRoleRepository);
    }

    public function toggleRelation(string|int $menuId, string|int $roleId): bool
    {
        $check = $this->menuRoleRepository->getByMenuAndRole($menuId, $roleId);
        if ($check) {
            return $this->menuRoleRepository->deleteByMenuAndRole($menuId, $roleId);
        }
        $createData = [
            'menu_id' => $menuId,
            'role_id' => $roleId
        ];
        $this->menuRoleRepository->create($createData);
        return true;
    }
}
