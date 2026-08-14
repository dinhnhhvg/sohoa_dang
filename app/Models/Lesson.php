<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends BaseModel
{
    protected $fillable = [
        'class_id',
        'type_id',
        'status_id',
        'name',
        'content',
        'value',
        'date',
        'start_time',
        'end_time',
        'duration',
        'center_id',
        'classroom_id'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function lessonCustomers(): HasMany
    {
        return $this->hasMany(LessonCustomer::class);
    }
}
