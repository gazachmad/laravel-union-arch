<?php

namespace App\Modules\IAM\Core\Application\Services\Logout;

use App\Modules\IAM\Core\Domain\Services\AuthService;

class LogoutService
{
    public function __construct(private AuthService $auth_service) {}

    public function execute(): void
    {
        $this->auth_service->logout();
    }
}
