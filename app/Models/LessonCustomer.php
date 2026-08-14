<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonCustomer extends BaseModel
{
    protected $guarded = [];

    public function classCustomer(): BelongsTo
    {
        return $this->belongsTo(ClassCustomer::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
