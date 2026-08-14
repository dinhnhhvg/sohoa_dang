<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Course extends BaseModel
{
    protected $fillable = [
        'code',
        'name',
        'slug',
        'price',
        'image',
        'duration',
        'introduce',
        'content',
        'description',
        'meta_description',
        'category_id',
        'level_id',
        'order_number',
        'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
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
        static::deleting(function ($course) {
            $course->itemTopics()->delete();
            $course->itemMedias()->delete();
        });
    }

    public function topics(): MorphToMany
    {
        return $this->morphToMany(Topic::class, 'item', 'item_topics', 'item_id', 'topic_id');
    }

    public function courseTypes(): HasMany
    {
        return $this->hasMany(CourseType::class, 'course_id', 'id');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('order_number', 'ASC');
    }
}
