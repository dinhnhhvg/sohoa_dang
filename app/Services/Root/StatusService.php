<?php

namespace App\Services\Root;

use App\Repositories\StatusRepository;
use App\Services\BaseService;

class StatusService extends BaseService
{
    public function __construct(
        protected StatusRepository $statusRepository
    )
    {
        parent::__construct($statusRepository);
    }
}
