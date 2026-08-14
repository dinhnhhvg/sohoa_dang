<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends BaseModel
{
    protected $table = 'classes';

    protected $fillable = [
        'course_type_id',
        'name',
        'slug',
        'code',
        'description',
        'status_id',
        'start_date',
        'end_date',
        'center_id',
        'classroom_id',
        'schedule',
        'capacity',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function courseType(): BelongsTo
    {
        return $this->belongsTo(courseType::class)
            ->with(['course', 'type']);
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function classCustomers(): HasMany
    {
        return $this->hasMany(ClassCustomer::class, 'class_id', 'id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'class_id', 'id');
    }

    public function lessonDone(): HasMany
    {
        return $this->hasMany(Lesson::class, 'class_id', 'id')->where('lessons.status_id', 11);
    }
}
