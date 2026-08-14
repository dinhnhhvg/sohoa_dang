<?php

namespace App\Models;

class Holiday extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
