<?php

namespace App\Modules\Auth\Core\Application\Services\ResetPassword;

use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;
use Exception;

class ResetPasswordService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthenticateService $authenticate_service
    ) {}

    public function execute(ResetPasswordRequest $request): void
    {
        $user = $this->user_repository->findByEmail(new Email($request->getEmail()));

        if (!$user) {
            throw new Exception('User not found');
        }

        $this->authenticate_service->resetPassword(
            $request->getToken(),
            $user->getEmail(),
            $request->getPassword(),
            $request->getPasswordConfirmation()
        );

        $user->setPassword(Password::from($request->getPassword()));

        $this->user_repository->persist($user);
    }
}
