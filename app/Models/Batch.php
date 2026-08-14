<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Batch extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function oldAgency(): BelongsTo
    {
        return $this->belongsTo(OldAgency::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function judgments(): HasMany
    {
        return $this->hasMany(Judgment::class);
    }

    public function defendants(): HasManyThrough
    {
        return $this->hasManyThrough(
            Defendant::class,
            Judgment::class,
            'batch_id',
            'judgment_id',
            'id',
            'id'
        );
    }

    public function  entryJudgments(): HasMany
    {
        return $this->hasMany(Judgment::class)->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
    }

    public function  checkJudgments(): HasMany
    {
        return $this->hasMany(Judgment::class)->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
    }

    public function judgmentDocuments(): HasManyThrough
    {
        return $this->hasManyThrough(
            JudgmentDocument::class,
            Judgment::class,
            'batch_id',
            'judgment_id',
            'id',
            'id'
        );
    }

    public function entryJudgmentDocuments(): HasManyThrough
    {
        return $this->hasManyThrough(
                JudgmentDocument::class,
                Judgment::class,
                'batch_id',
                'judgment_id',
                'id',
                'id'
            )->whereIn('judgment_documents.status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
    }

    public function checkJudgmentDocuments(): HasManyThrough
    {
        return $this->hasManyThrough(
                JudgmentDocument::class,
                Judgment::class, 'batch_id',
                'judgment_id',
                'id',
                'id'
            )->where('judgment_documents.status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
    }

    public function entries(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'batch_entries', 'batch_id', 'user_id');
    }

    public function checkers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'batch_checkers', 'batch_id', 'user_id');
    }
}
