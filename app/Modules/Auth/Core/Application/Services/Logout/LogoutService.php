<?php

namespace App\Modules\Auth\Core\Application\Services\Logout;

use App\Modules\Auth\Core\Domain\Services\AuthenticateService;

class LogoutService
{
    public function __construct(private AuthenticateService $authenticate_service) {}

    public function execute(): void
    {
        $this->authenticate_service->logout();
    }
}
