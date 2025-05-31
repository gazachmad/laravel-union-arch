<?php

namespace App\Modules\IAM\Infrastructure\Services;

use App\Modules\IAM\Core\Domain\Services\AuthService;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\PhoneNumber;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class LaravelAuthService implements AuthService
{
    public function attempt(PhoneNumber $phone_number, string $password, bool $remember): void
    {
        $attempted = Auth::attempt([
            'phone_number' => $phone_number,
            'password' => $password,
        ], $remember);

        if (!$attempted) {
            throw new Exception('Invalid credentials');
        }

        Session::regenerate();
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
