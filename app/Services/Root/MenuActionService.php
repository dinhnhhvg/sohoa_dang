<?php

namespace App\Services\Root;

use App\Repositories\MenuActionRepository;
use App\Services\BaseService;

class MenuActionService extends BaseService
{
    public function __construct(
        protected MenuActionRepository $menuActionRepository,
    )
    {
        parent::__construct($menuActionRepository);
    }
}
