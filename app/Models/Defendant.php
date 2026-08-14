<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Defendant extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'identity_created_date' => 'date',
        'identity_expiry_date' => 'date',
        'birth_date' => 'date',
        'prohibition_start_date' => 'date',
        'judicial_measure_start_date' => 'date',
        'judicial_measure_end_date' => 'date',
        'execution_date' => 'date'
    ];

    public function judgment(): BelongsTo
    {
        return $this->belongsTo(Judgment::class);
    }

    public function judgmentDocument(): BelongsTo
    {
        return $this->belongsTo(JudgmentDocument::class);
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function identityDocument(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'identity_document_id');
    }

    public function foreignIdentityDocument(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'foreign_identity_document_id');
    }

    public function judicialMeasureIssuer(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'judicial_measure_issuer_id');
    }

    public function litigationStatus(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'litigation_status_id');
    }

    public function permanentProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'permanent_province_id', 'id');
    }

    public function permanentWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'permanent_ward_id', 'id');
    }

    public function permanentOldProvince(): BelongsTo
    {
        return $this->belongsTo(OldProvince::class, 'permanent_old_province_id', 'id');
    }

    public function permanentOldDistrict(): BelongsTo
    {
        return $this->belongsTo(OldDistrict::class, 'permanent_old_district_id', 'id');
    }

    public function permanentOldWard(): BelongsTo
    {
        return $this->belongsTo(OldWard::class, 'permanent_old_ward_id', 'id');
    }

    public function hometownProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'hometown_province_id', 'id');
    }

    public function hometownWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'hometown_ward_id', 'id');
    }

    public function hometownOldProvince(): BelongsTo
    {
        return $this->belongsTo(OldProvince::class, 'hometown_old_province_id', 'id');
    }

    public function hometownOldDistrict(): BelongsTo
    {
        return $this->belongsTo(OldDistrict::class, 'hometown_old_district_id', 'id');
    }

    public function hometownOldWard(): BelongsTo
    {
        return $this->belongsTo(OldWard::class, 'hometown_old_ward_id', 'id');
    }

    public function organizationProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'organization_province_id', 'id');
    }

    public function organizationWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'organization_ward_id', 'id');
    }

    public function organizationOldProvince(): BelongsTo
    {
        return $this->belongsTo(OldProvince::class, 'organization_old_province_id', 'id');
    }

    public function organizationOldDistrict(): BelongsTo
    {
        return $this->belongsTo(OldDistrict::class, 'organization_old_district_id', 'id');
    }

    public function organizationOldWard(): BelongsTo
    {
        return $this->belongsTo(OldWard::class, 'organization_old_ward_id', 'id');
    }

    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(Config::class, 'marital_status_id', 'id');
    }

    public function nationalities(): BelongsToMany
    {
        return $this->belongsToMany(Nationality::class, 'defendant_nationalities', 'defendant_id', 'nationality_id');
    }

    public function judicialMeasureNames(): BelongsToMany
    {
        return $this->belongsToMany(Config::class, 'defendant_judicial_measure_names', 'defendant_id', 'judicial_measure_name_id');
    }

    public function legalRelationships(): BelongsToMany
    {
        return $this->belongsToMany(Config::class, 'defendant_legal_relationships', 'defendant_id', 'legal_relationship_id');
    }

    public function mainPenalties(): BelongsToMany
    {
        return $this->belongsToMany(Config::class, 'defendant_penalties', 'defendant_id', 'penalty_id')
            ->withPivot('is_main')
            ->wherePivot('is_main', 1);
    }

    public function additionalPenalties(): BelongsToMany
    {
        return $this->belongsToMany(Config::class, 'defendant_penalties', 'defendant_id', 'penalty_id')
            ->withPivot('is_main')
            ->wherePivot('is_main', 0);
    }
}
