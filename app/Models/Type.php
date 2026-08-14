<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends BaseModel
{
    protected $guarded = [];

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }
}
