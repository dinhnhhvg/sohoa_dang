<?php

namespace App\Services\Admin\Auth;

use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService extends BaseService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
        parent::__construct($userRepository);
    }

    public function login(Request $request): bool
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            createLoginSession('user', $this->userRepository->find(Auth::guard('user')->id()));
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        Auth::guard('user')->logout();
        Session::flush();
    }
}
