<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AlohubExtension extends BaseModel
{
    protected $guarded = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_alohub_extensions', 'alohub_extension_id', 'user_id');
    }
}
