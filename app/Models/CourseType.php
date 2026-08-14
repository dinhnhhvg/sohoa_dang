<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseType extends BaseModel
{
    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
