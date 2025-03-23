<?php

namespace App\Modules\Auth\Core\Application\Services\Login;

use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use Exception;

class LoginService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthenticateService $authenticate_service
    ) {}

    public function execute(LoginRequest $request): void
    {
        $user = $this->user_repository->findByUsername($request->getUsername());

        if (!$user) {
            throw new Exception('Invalid credentials');
        }

        if (!$user->getPassword()->verify($request->getPassword())) {
            throw new Exception('Invalid credentials');
        }

        $attempted = $this->authenticate_service->attempt(
            $request->getUsername(),
            $request->getPassword(),
            $request->isRemember()
        );

        if (!$attempted) {
            throw new Exception('Invalid credentials');
        }
    }
}
