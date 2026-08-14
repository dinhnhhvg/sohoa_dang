<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel
{
    protected $guarded = [];

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class)->orderBy('order_number', 'ASC');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')
            ->orderBy('order_number', 'ASC');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }
}
