<?php

namespace App\Modules\Shared\Model;

use Exception;

class Password
{
    public function __construct(protected string $password_hash) {}

    public static function from(string $password): self
    {
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
            throw new Exception('Password must be at least 8 characters long and contain both letters and numbers');
        }

        return new self(password_hash($password, PASSWORD_DEFAULT));
    }

    public function verify(string $password): bool
    {
        return password_verify($password, $this->password_hash);
    }

    public function __toString(): string
    {
        return $this->password_hash;
    }
}
