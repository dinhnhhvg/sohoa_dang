<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends BaseAuthenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'role_id',
        'center_id',
        'customer_tag_id',
        'channel_id',
        'agency_id',
        'sale_id',
        'code',
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'gender',
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

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
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

    public function customerTag(): BelongsTo
    {
        return $this->belongsTo(CustomerTag::class);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sale_id', 'id');
    }
}
