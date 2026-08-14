<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class ItemMedia extends BaseModel
{
    protected $table = 'item_medias';

    protected $guarded = [];

    public function item(): MorphTo
    {
        return $this->morphTo();
    }
}
