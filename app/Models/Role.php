<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends BaseModel
{
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_roles', 'role_id', 'menu_id')
            ->whereNull('menus.parent_id')
            ->orderBy('menus.order_number', 'ASC');
    }

    public function menuActions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'role_menu_action', 'role_id', 'menu_action_id')
            ->with(['menu', 'action']);
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'role_menu_actions', 'role_id', 'action_id');
    }
}
