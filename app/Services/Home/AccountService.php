<?php

namespace App\Services\Home;

use App\Repositories\AccountRepository;
use App\Services\BaseService;

class AccountService extends BaseService
{
    public function __construct(
        protected AccountRepository $accountRepository
    )
    {
        parent::__construct($this->accountRepository);
    }

    public function login(): array
    {
        $filters['is_active'] = [1];
        return [
            'accounts' => $this->accountRepository->get($filters)
        ];
    }
}
