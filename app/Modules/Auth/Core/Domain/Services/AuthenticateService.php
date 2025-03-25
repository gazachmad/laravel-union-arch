<?php

namespace App\Modules\Auth\Core\Domain\Services;

use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\PhoneNumber;

interface AuthenticateService
{
    public function attempt(PhoneNumber $phone_number, string $password, bool $remember): bool;

    public function logout(): void;

    public function sendResetPasswordLink(Email $email): void;

    public function resetPassword(string $token, Email $email, string $password, string $password_confirmation): void;
}
