<?php

namespace App\Http\Controllers\Web\Admin\Auth;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    )
    {
        parent::__construct($authService, env('APP_VIEW_PATH_ADMIN').'.auth');
    }

    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('admin');
        }
        return view($this->viewPath.'.login');
    }

    public function login(Request $request): RedirectResponse
    {
        if (!$this->authService->login($request)) {
            return redirect()->route('admin.login')->with('error', __('auth.failed'))->withInput();
        }
        return redirect()->route('admin')->with('success', __('app.message.login_success'));
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();
        return redirect()->route('admin.login')->with('success', __('auth.logout_success'));
    }
}
