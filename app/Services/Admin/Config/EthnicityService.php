<?php

namespace App\Services\Admin\Config;

use App\Repositories\EthnicityRepository;
use App\Services\BaseService;

class EthnicityService extends BaseService
{
    public function __construct(
        protected EthnicityRepository $ethnicityRepository
    )
    {
        parent::__construct($ethnicityRepository);
    }
}
