<?php

namespace App\Modules\Auth\Infrastructure\Services;

use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use App\Modules\Shared\Model\Email;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class LaravelAuthenticateService implements AuthenticateService
{
    public function __construct(private UserRepository $user_repository) {}

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

    public function sendResetPasswordLink(Email $email): void
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw new Exception($status);
        }
    }

    public function resetPassword(string $token, Email $email, string $password, string $password_confirmation): void
    {
        $status = Password::reset([
            'token' => $token,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ], function () {});

        if ($status !== Password::PASSWORD_RESET) {
            throw new Exception($status);
        }
    }
}
