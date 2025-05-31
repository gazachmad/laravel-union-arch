<?php

namespace App\Modules\IAM\Core\Application\Services\Login;

class LoginRequest
{
    public function __construct(
        private string $phone_number,
        private string $password,
        private bool $remember
    ) {}

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
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
