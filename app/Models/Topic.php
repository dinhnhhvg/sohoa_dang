<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends BaseModel
{
    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
