<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'coupon_id', 'id');
    }
}
