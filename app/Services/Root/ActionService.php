<?php

namespace App\Services\Root;

use App\Repositories\ActionRepository;
use App\Services\BaseService;

class ActionService extends BaseService
{
    public function __construct(
        protected ActionRepository $actionRepository
    )
    {
        parent::__construct($actionRepository);
    }
}
