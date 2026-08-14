<?php

namespace App\Http\Controllers\Web\Home\User;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
        parent::__construct($userService, env('APP_VIEW_PATH_HOME').'.user.user');
    }
}
