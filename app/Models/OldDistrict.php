<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OldDistrict extends BaseModel
{
    protected $guarded = [];

    public function oldProvince(): BelongsTo
    {
        return $this->belongsTo(OldProvince::class);
    }

    public function oldWards(): HasMany
    {
        return $this->hasMany(OldWard::class);
    }
}
