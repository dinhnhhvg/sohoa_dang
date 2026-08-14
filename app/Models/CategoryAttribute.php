<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryAttribute extends BaseModel
{
    protected $table = 'category_attributes';

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function valuesByCategory(string|int $category_id): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_id')
            ->where('category_id', $category_id);
    }
}
