<?php

namespace App\Modules\Auth\Core\Domain\Services;

interface AuthenticateService
{
    public function attempt(string $username, string $password, bool $remember): bool;

    public function logout(): void;
}
