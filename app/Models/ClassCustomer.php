<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassCustomer extends BaseModel
{
    protected $fillable = [
        'class_id',
        'customer_id',
        'status_id',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function lessonCustomers(): HasMany
    {
        return $this->hasMany(LessonCustomer::class);
    }

    public function lessonCustomerDone(): HasMany
    {
        return $this->hasMany(LessonCustomer::class)->whereNotNull('status_id');
    }
}
