<?php

namespace App\Modules\IAM\Core\Application\Services\SendResetPasswordLink;

class SendResetPasswordLinkRequest
{
    public function __construct(private string $email) {}

    public function getEmail(): string
    {
        return $this->email;
    }
}
