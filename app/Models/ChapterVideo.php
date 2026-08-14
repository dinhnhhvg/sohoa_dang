<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChapterVideo extends BaseModel
{
    protected $guarded = [];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
