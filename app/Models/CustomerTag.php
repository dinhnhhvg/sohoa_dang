<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerTag extends BaseModel
{
    protected $guarded = [];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
