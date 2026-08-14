<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends BaseModel
{
    protected $guarded = [];

    public function campaignCustomers(): HasMany
    {
        return $this->hasMany(CampaignCustomer::class);
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }
}
