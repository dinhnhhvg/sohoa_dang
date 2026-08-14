<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends BaseModel
{
    protected $guarded = [];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'chapter_types');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(ChapterVideo::class, 'chapter_id', 'id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ChapterDocument::class, 'chapter_id', 'id');
    }
}
