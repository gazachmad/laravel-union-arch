<?php

namespace App\Modules\Shared\Model;

use Exception;

class Email
{
    public function __construct(private string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email");
        }
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
