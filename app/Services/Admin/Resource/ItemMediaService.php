<?php

namespace App\Services\Admin\Resource;

use App\Repositories\ItemMediaRepository;
use App\Services\BaseService;

class ItemMediaService extends BaseService
{
    public function __construct(
        protected ItemMediaRepository $itemMediaRepository,
    )
    {
        parent::__construct($itemMediaRepository);
    }
}
