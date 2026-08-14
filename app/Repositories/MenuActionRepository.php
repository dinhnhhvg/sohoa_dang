<?php

namespace App\Repositories;

use App\Models\MenuAction;

class MenuActionRepository extends BaseRepository
{
    public function __construct(
        protected MenuAction $menuAction
    )
    {
        parent::__construct($menuAction);
    }
}
