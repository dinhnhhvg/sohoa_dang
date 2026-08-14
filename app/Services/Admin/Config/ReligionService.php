<?php

namespace App\Services\Admin\Config;

use App\Repositories\ReligionRepository;
use App\Services\BaseService;

class ReligionService extends BaseService
{
    public function __construct(
        protected ReligionRepository $religionRepository
    )
    {
        parent::__construct($religionRepository);
    }
}
