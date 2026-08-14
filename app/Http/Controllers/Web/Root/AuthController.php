<?php

namespace App\Http\Controllers\Web\Root;

use App\Http\Controllers\Web\Controller;
use App\Services\Root\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    )
    {
        parent::__construct($authService, env('APP_VIEW_PATH_ROOT').'.auth');
    }

    public function showLogin(): View|RedirectResponse
    {
        if ($this->authService->checkLogin()) {
            return redirect()->route('root');
        }
        return view($this->viewPath.'.login');
    }

    public function login(Request $request): RedirectResponse
    {
        if (!$this->authService->login($request)) {
            return redirect()->route('root.login')->with('error', __('auth.failed'))->withInput();
        }
        return redirect()->route('root')->with('success', __('app.message.login_success'));
    }

    public function logout(): RedirectResponse
    {
        return redirect()->route('root.login')->with('success', __('auth.logout_success'))->withInput();
    }
}
