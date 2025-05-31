<?php

namespace App\Modules\IAM\Core\Application\Services\Register;

class RegisterRequest
{
    public function __construct(
        private string $name,
        private string $phone_number,
        private string $email,
        private string $password,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
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
