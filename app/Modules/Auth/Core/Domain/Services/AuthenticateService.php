<?php

namespace App\Modules\Auth\Core\Domain\Services;

use App\Modules\Shared\Model\Email;

interface AuthenticateService
{
    public function attempt(string $username, string $password, bool $remember): bool;

    public function logout(): void;

    public function sendResetPasswordLink(Email $email): void;

    public function resetPassword(string $token, Email $email, string $password, string $password_confirmation): void;
}
