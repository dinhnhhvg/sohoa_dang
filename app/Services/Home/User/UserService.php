<?php

namespace App\Services\Home\User;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {
        parent::__construct($userRepository);
    }
}
