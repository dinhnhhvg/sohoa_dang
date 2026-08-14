<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAlohub
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $alohubExtension = $user->alohubExtensions()?->first();
        if (env("ALOHUB_WEBSOCKET_SERVER_URL") && env("ALOHUB_PUBLIC_IDENTITY") && $alohubExtension?->extension && $alohubExtension->password) {
            $alohubData = [
                "txtWebsocketServerUrl" => env("ALOHUB_WEBSOCKET_SERVER_URL"),
                "txtDisplayName" => $user->id,
                "txtPublicIdentity" => str_replace("{extension}", $alohubExtension?->extension, env("ALOHUB_PUBLIC_IDENTITY")),
                "txtPassword" => $alohubExtension->password,
                "xCrmInfo" => [
                    "user_id" => $user->id
                ]
            ];
        } else {
            $alohubData = null;
        }

        View::share("alohubData", $alohubData);
        return $next($request);
    }
}
