<?php

namespace App\Services\Admin\Config;

use App\Repositories\NationalityRepository;
use App\Services\BaseService;

class NationalityService extends BaseService
{
    public function __construct(
        protected NationalityRepository $nationalityRepository
    )
    {
        parent::__construct($nationalityRepository);
    }
}
