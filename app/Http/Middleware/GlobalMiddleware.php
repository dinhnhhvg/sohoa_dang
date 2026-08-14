<?php

namespace App\Http\Middleware;

use App\Libraries\LanguageLibrary;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class GlobalMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Count user online
        if (auth()->check()) {
            $userId = auth()->id();
            $onlineUsers = cache()->get('online-users', []);
            $onlineUsers[$userId] = now()->timestamp;
            cache()->put('online-users', $onlineUsers, now()->addMinutes(5));
        }

        // Set language
        $activeLanguages = (new LanguageLibrary())->get();
        $locale = Cookie::get('active_locale');

        $locale = $locale && isset($activeLanguages[$locale]) && $activeLanguages[$locale] ? $locale : env('APP_LOCALE');
        App::setLocale($locale);

        View::share('activeLanguages', $activeLanguages);
        View::share('activeLanguage', $locale);

        return $next($request);
    }
}
