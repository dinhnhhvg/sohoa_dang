<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agency extends BaseModel
{
    protected $guarded = [];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }
}
