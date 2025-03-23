<?php

namespace App\Modules\Shared\Model;

class Password
{
    public function __construct(protected string $password_hash) {}

    public static function from(string $password): self
    {
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
