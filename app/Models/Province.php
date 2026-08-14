<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends BaseModel
{
    protected $guarded = [];

    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class);
    }
}
