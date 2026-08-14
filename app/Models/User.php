<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseAuthenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'role_id',
        'center_id',
        'code',
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'gender',
        'note_value',
        'care_value',
        'is_active',
        'province_id',
        'ward_id',
        'address',

        'birth_date',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'password' => 'hashed',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function alohubExtensions(): BelongsToMany
    {
        return $this->belongsToMany(AlohubExtension::class, 'user_alohub_extensions', 'user_id', 'alohub_extension_id');
    }

    public function entryJudgments(): HasMany
    {
        return $this->hasMany(Judgment::class, 'entry_id');
    }

    public function checkJudgments(): HasMany
    {
        return $this->hasMany(Judgment::class, 'checker_id');
    }

    public function entryJudgmentDocuments(): HasManyThrough
    {
        return $this->hasManyThrough(
            JudgmentDocument::class,
            Judgment::class,
            'entry_id',
            'judgment_id',
            'id',
            'id'
        );
    }

    public function checkJudgmentDocuments(): HasManyThrough
    {
        return $this->hasManyThrough(
            JudgmentDocument::class,
            Judgment::class,
            'checker_id',
            'judgment_id',
            'id',
            'id'
        );
    }

    public function entryDefendants(): HasManyThrough
    {
        return $this->hasManyThrough(
            Defendant::class,
            Judgment::class,
            'entry_id',
            'judgment_id',
            'id',
            'id'
        );
    }

    public function checkDefendants(): HasManyThrough
    {
        return $this->hasManyThrough(
            Defendant::class,
            Judgment::class,
            'checker_id',
            'judgment_id',
            'id',
            'id'
        );
    }
}

