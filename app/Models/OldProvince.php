<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class OldProvince extends BaseModel
{
    protected $guarded = [];

    public function oldDistricts(): HasMany
    {
        return $this->hasMany(OldDistrict::class);
    }
}
