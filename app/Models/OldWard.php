<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OldWard extends BaseModel
{
    protected $guarded = [];

    public function oldDistrict(): BelongsTo
    {
        return $this->belongsTo(OldDistrict::class);
    }
}
