<?php

namespace App\Http\Middleware\Authenticated;

class AuthenticatedResponse
{
    public function __construct(
        private string $name,
        private string $phone_number,
        private string $email,
        private string $initial,
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

    public function getInitial(): string
    {
        return $this->initial;
    }
}
