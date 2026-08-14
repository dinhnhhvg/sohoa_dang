<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends BaseModel
{
    protected $guarded = [];

    public function categoryAttributes(): HasMany
    {
        return $this->hasMany(CategoryAttribute::class)
            ->with(['category']);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_attributes', 'attribute_id', 'category_id');
    }
}

