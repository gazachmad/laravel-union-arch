<?php

namespace App\Modules\Auth\Infrastructure\Services;

use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LaravelAuthenticateService implements AuthenticateService
{
    public function attempt(string $username, string $password, bool $remember): bool
    {
        $attempted = Auth::attempt([
            'username' => $username,
            'password' => $password,
        ], $remember);

        Session::regenerate();

        return $attempted;
    }

    public function logout(): void
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();
    }
}
