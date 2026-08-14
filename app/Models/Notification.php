<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'read_at' => 'datetime'
    ];

    public function senderBy(): MorphTo
    {
        return $this->morphTo();
    }
}
