<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Home\Menu\MenuService;
use App\Services\Root\AuthService;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Throwable;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards): mixed
    {
        $this->authenticate($request, $guards);

        if (session('account') === 'root') {
            return $next($request);
        }

        $menuService = app(MenuService::class);
        $activeMenus = $menuService->getActiveMenuByRole(session()->all());
        View::share('activeMenus', $activeMenus);

        if (session('role_code') === 'admin' || !$activeMenus) {
            return $next($request);
        }

        $allMenus = $menuService->getMenuByAccount(session('account'));
        $allRouters = [];
        foreach ($allMenus as $menu) {
            if ($menu->router) {
                foreach ($menu->actions as $action) {
                    foreach (explode(',', $action->keys) as $key) {
                        $allRouters[] = str_replace('.index', '', $menu->router) . '.' . $key;
                    }
                }
            }
            foreach ($menu->menus as $subMenu) {
                if ($subMenu->router) {
                    foreach ($subMenu->actions as $action) {
                        foreach (explode(',', $action->keys) as $key) {
                            $allRouters[] = str_replace('.index', '', $subMenu->router) . '.' . $key;
                        }
                    }
                }
            }
        }

        $activeRouters = [];
        foreach ($activeMenus as $menu) {
            if ($menu->router) {
                foreach ($menu->menuActions as $menuAction) {
                    if (isset($menuAction->action->keys) && $menuAction->action->keys) {
                        foreach (explode(',', $menuAction->action->keys) as $key) {
                            $activeRouters[] = str_replace('.index', '', $menu->router) . '.' . $key;
                        }
                    }
                }
            }
            foreach ($menu['menus'] as $subMenu) {
                if ($subMenu->router) {
                    foreach ($subMenu->menuActions as $menuAction) {
                        if (isset($menuAction->action->keys) && $menuAction->action->keys) {
                            foreach (explode(',', $menuAction->action->keys) as $key) {
                                $activeRouters[] = str_replace('.index', '', $subMenu->router) . '.' . $key;
                            }
                        }
                    }
                }
            }
        }

        $inactiveRouters = array_diff($allRouters, $activeRouters);
        $response = $next($request);
        $content = $response->getContent();

        $appUrl = preg_quote(env('APP_URL'), '/');
        $pattern = "/{$appUrl}[^\"' <)]+/i";
        preg_match_all($pattern, $content, $matches);
        foreach ($matches[0] as $link) {
            $routerName = $this->getRouteNameFromUrl($link);
            if ($routerName && in_array($routerName, $inactiveRouters)) {
                $patternA = '#<a[^>]*' . preg_quote($link, '#') . '[^>]*>.*?</a>#si';
                $content = preg_replace($patternA, '', $content);

                $patternForm = '#<form[^>]*' . preg_quote($link, '#') . '[^>]*>.*?</form>#si';
                $content = preg_replace($patternForm, '', $content);
            }
        }
        $response->setContent($content);
        return $response;
    }

    public function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('account.login');
    }

    public function authenticate($request, array $guards): void
    {
        if (empty($guards)) {
            $guards = [null];
        }
        foreach ($guards as $guard) {
            if ($guard === 'root') {
                $rootAuthService = app(AuthService::class);
                if ($rootAuthService->checkLogin()) {
                    session(['account' => $guard]);
                    return;
                }
            } else if ($this->auth->guard($guard)->check()) {
                session(['account' => $guard]);
                return;
            }
        }

        $this->unauthenticated($request, $guards);
    }

    private function getRouteNameFromUrl(string $url): ?string
    {
        try {
            $path = parse_url($url, PHP_URL_PATH);
            $routes = Route::getRoutes();
            foreach ($routes as $route) {
                if ($route->matches(Request::create($path, $route->methods()[0]))) {
                    return $route->getName();
                }
            }
            return null;
        } catch (Throwable) {
            return null;
        }
    }
}
