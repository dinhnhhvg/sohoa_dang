<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItem extends BaseModel
{
    protected $guarded = [];

    public function item(): MorphTo
    {
        return $this->morphTo();
    }
}
