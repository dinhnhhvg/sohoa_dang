<?php

namespace App\Services\Admin\Resource;

use App\Repositories\SettingRepository;
use App\Services\BaseService;

class FileManageService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository
    )
    {
        parent::__construct($settingRepository);
    }
}
