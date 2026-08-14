<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends BaseModel
{
    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
