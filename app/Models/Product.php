<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends BaseModel
{
    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function itemTopics(): MorphMany
    {
        return $this->morphMany(ItemTopic::class, 'item');
    }

    public function itemMedias(): MorphMany
    {
        return $this->morphMany(ItemMedia::class, 'item')
            ->orderBy('order_number', 'ASC');
    }

    public static function booted(): void
    {
        static::deleting(function ($product) {
            $product->itemTopics()->delete();
            $product->itemMedias()->delete();
        });
    }

    public function topics(): MorphToMany
    {
        return $this->morphToMany(Topic::class, 'item', 'item_topics', 'item_id', 'topic_id');
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values', 'product_id', 'attribute_value_id');
    }

    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'product_addons', 'product_id', 'addon_product_id');
    }
}
