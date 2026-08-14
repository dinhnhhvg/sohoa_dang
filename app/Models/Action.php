<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends BaseModel
{
    protected $guarded = [];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_actions', 'action_id', 'menu_id');
    }
}
