<?php

namespace App\Http\Middleware\AuthAccount;

class AuthAccountResponse
{
    public function __construct(
        private string $name,
        private string $phone_number,
        private string $email,
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
        preg_match_all('#(?<=\s|\b)\pL#u', $this->name, $res);
        $initials = implode('', $res[0]);

        if (strlen($initials) < 2) {
            $initials = substr($this->name, 0, 2);
        } else {
            $initials = substr($initials, 0, 2);
        }

        return strtoupper($initials);
    }
}
