<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class JudgmentDocument extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'issue_date' => 'date'
    ];

    public function judgment(): BelongsTo
    {
        return $this->belongsTo(Judgment::class, 'judgment_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'judgment_document_languages', 'judgment_document_id', 'language_id');
    }

    public function physicalCondition(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'physical_condition_id');
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'document_type_id');
    }

    public function documentGenre(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'document_genre_id');
    }

    public function usageMode(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'usage_mode_id');
    }

    public function confidentialityLevel(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'confidentiality_level_id');
    }

    public function copyType(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'copy_type_id');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function oldAgency(): BelongsTo
    {
        return $this->belongsTo(OldAgency::class);
    }



    public function itemNotes(): MorphMany
    {
        return $this->morphMany(ItemNote::class, 'item')
            ->with(['createdBy', 'status', 'channel']);
    }

    public static function booted(): void
    {
        static::deleting(function ($judgmentDocument) {
            $judgmentDocument->itemNotes()->delete();
        });
    }
}
