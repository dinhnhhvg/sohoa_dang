<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuAction extends BaseModel
{
    protected $guarded = [];

    public $timestamps = false;

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class, 'action_id', 'id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_menu_actions', 'menu_action_id', 'role_id')
            ->withPivot('role_id');
    }
}
