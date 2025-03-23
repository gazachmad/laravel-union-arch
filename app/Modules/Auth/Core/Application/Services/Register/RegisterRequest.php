<?php

namespace App\Modules\Auth\Core\Application\Services\Register;

class RegisterRequest
{
    public function __construct(
        private string $name,
        private string $username,
        private string $email,
        private string $password,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
