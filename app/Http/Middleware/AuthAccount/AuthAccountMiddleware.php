<?php

namespace App\Http\Middleware\AuthAccount;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AuthAccountMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        View::share('auth_user', new AuthAccountResponse(
            $user->name,
            $user->phone_number,
            $user->email,
        ));

        return $next($request);
    }
}
