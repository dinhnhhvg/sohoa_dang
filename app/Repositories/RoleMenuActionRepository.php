<?php

namespace App\Repositories;

use App\Models\RoleMenuAction;
use Illuminate\Database\Eloquent\Model;

class RoleMenuActionRepository extends BaseRepository
{
    public function __construct(
        protected RoleMenuAction $roleMenuAction
    )
    {
        parent::__construct($roleMenuAction);
    }

    public function getByRoleAndMenuAction(string|int $roleId, string|int $menuActionId): ?Model
    {
        return $this->model->where(['role_id' => $roleId, 'menu_action_id' => $menuActionId])->first();
    }

    public function deleteByRoleAndMenuAction(string|int $roleId, string|int $menuActionId): bool
    {
        return $this->model->where(['role_id' => $roleId, 'menu_action_id' => $menuActionId])->delete();
    }
}
