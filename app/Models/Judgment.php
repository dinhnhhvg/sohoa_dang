<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Judgment extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'entried_at' => 'timestamp',
        'checked_at' => 'timestamp',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'judgment_languages', 'judgment_id', 'language_id');
    }

    public function font(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'font_id');
    }

    public function physicalCondition(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'physical_condition_id');
    }

    public function entry(): BelongsTo
    {
        return $this->belongsTo(User::class, 'entry_id');
    }

    public function checker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checker_id');
    }

    public function judgmentDocuments(): HasMany
    {
        return $this->hasMany(JudgmentDocument::class);
    }

    public function tenurePeriod(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'tenure_period_id');
    }

    public function retentionPeriod(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'retention_period_id');
    }

    public function entryJudgmentDocuments(): HasMany
    {
        return $this->hasMany(JudgmentDocument::class)
            ->whereIn('status_id', [env('APP_JUDGMENT_STATUS_ENTRIED_ID'), env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
    }

    public function checkJudgmentDocuments(): HasMany
    {
        return $this->hasMany(JudgmentDocument::class)
            ->where('status_id', env('APP_JUDGMENT_STATUS_CHECKED_ID'));
    }
}
