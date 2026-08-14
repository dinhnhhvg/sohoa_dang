<?php

namespace App\Services\Root;

use App\Repositories\SettingRepository;
use App\Services\BaseService;

class DashboardService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository
    )
    {
        parent::__construct($settingRepository);
    }
}
