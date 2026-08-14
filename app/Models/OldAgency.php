<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OldAgency extends BaseModel
{
    protected $guarded = [];

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }

    public function oldAgency(): HasOne
    {
        return $this->hasOne(OldAgency::class);
    }
}
