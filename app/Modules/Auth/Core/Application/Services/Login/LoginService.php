<?php

namespace App\Modules\Auth\Core\Application\Services\Login;

use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use App\Modules\Shared\Model\PhoneNumber;
use Exception;

class LoginService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthenticateService $authenticate_service
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

        $attempted = $this->authenticate_service->attempt(
            $user->getPhoneNumber(),
            $request->getPassword(),
            $request->isRemember()
        );

        if (!$attempted) {
            throw new Exception('Invalid credentials');
        }
    }
}
