<?php

namespace App\Repositories;

use App\Models\MenuRole;
use Illuminate\Database\Eloquent\Model;

class MenuRoleRepository extends BaseRepository
{
    public function __construct(
        protected MenuRole $menuRole
    )
    {
        parent::__construct($menuRole);
    }

    public function getByMenuAndRole(string|int $menuId, string|int $roleId): ?Model
    {
        return $this->model->where(['menu_id' => $menuId, 'role_id' => $roleId])->first();
    }

    public function deleteByMenuAndRole(string|int $menuId, string|int $roleId): bool
    {
        return $this->model->where(['menu_id' => $menuId, 'role_id' => $roleId])->delete();
    }
}
