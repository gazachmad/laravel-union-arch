<?php

namespace App\Modules\Auth\Core\Application\Services\Login;

class LoginRequest
{
    public function __construct(
        private string $username,
        private string $password,
        private bool $remember
    ) {}

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function isRemember(): bool
    {
        return $this->remember;
    }
}
