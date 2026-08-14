<?php

namespace App\Services\Root;

use App\Repositories\AccountRepository;
use App\Services\BaseService;

class AccountService extends BaseService
{
    public function __construct(
        protected AccountRepository $accountRepository
    )
    {
        parent::__construct($accountRepository);
    }
}
