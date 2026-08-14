<?php

namespace App\Repositories;

use App\Models\AlohubExtension;

class AlohubExtensionRepository extends BaseRepository
{
    public function __construct(
        protected AlohubExtension $alohubExtension
    )
    {
        parent::__construct($alohubExtension);
    }
}
