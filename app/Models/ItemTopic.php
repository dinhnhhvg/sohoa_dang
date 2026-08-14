<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class ItemTopic extends BaseModel
{
    protected $guarded = [];

    public $timestamps = false;

    public function item(): MorphTo
    {
        return $this->morphTo();
    }
}
