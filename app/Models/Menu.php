<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends BaseModel
{
    protected $guarded = [];

    public function menus(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')
            ->orderBy('order_number', 'ASC');
    }

    public function menuActions(): HasMany
    {
        return $this->hasMany(MenuAction::class, 'menu_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'menu_roles', 'menu_id', 'role_id')
            ->withPivot('menu_id', 'role_id');
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'menu_actions', 'menu_id', 'action_id')
            ->withPivot('id', 'is_active');
    }
}
