<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRoom extends BaseModel
{
    protected $table = 'classrooms';

    protected $guarded = [];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
