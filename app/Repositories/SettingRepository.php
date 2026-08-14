<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SettingRepository extends BaseRepository
{
    public function __construct(
        protected Setting $setting
    ) {
        parent::__construct($setting);
    }

    public function getByKey(string $key): ?Model
    {
        return $this->model->where('key', $key)->first();
    }
}
