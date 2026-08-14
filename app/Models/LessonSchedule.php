<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonSchedule extends BaseModel
{
    protected $fillable = [
        'class_id',
        'type_id',
        'name',
        'day_of_week',
        'content',
        'value',
        'start_time',
        'end_time',
        'duration',
        'center_id',
        'classroom_id'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
