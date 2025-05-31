<?php

namespace App\Modules\IAM\Core\Application\Services\Login;

use App\Modules\IAM\Core\Domain\Repositories\UserRepository;
use App\Modules\IAM\Core\Domain\Services\AuthService;
use App\Modules\Shared\Model\PhoneNumber;
use Exception;

class LoginService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthService $auth_service
    ) {}

    public function execute(LoginRequest $request): void
    {
        $user = $this->user_repository->findByPhoneNumber(new PhoneNumber($request->getPhoneNumber()));

        if (!$user) {
            throw new Exception('Invalid credentials');
        }

        if (!$user->getPassword()->verify($request->getPassword())) {
            throw new Exception('Invalid credentials');
        }

        $this->auth_service->attempt(
            $user->getPhoneNumber(),
            $request->getPassword(),
            $request->isRemember()
        );
    }
}
