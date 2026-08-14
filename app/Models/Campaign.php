<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'campaign_sales', 'campaign_id', 'sale_id');
    }

    public function campaignCustomers(): HasMany
    {
        return $this->hasMany(CampaignCustomer::class, 'campaign_id', 'id');
    }
}
