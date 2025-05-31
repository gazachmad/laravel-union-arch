<?php

namespace App\Modules\IAM\Core\Application\Services\ResetPassword;

use App\Modules\IAM\Core\Domain\Repositories\UserRepository;
use App\Modules\IAM\Core\Domain\Services\AuthService;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;
use Exception;

class ResetPasswordService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthService $auth_service
    ) {}

    public function execute(ResetPasswordRequest $request): void
    {
        $user = $this->user_repository->findByEmail(new Email($request->getEmail()));

        if (!$user) {
            throw new Exception('User not found');
        }

        $this->auth_service->resetPassword(
            $request->getToken(),
            $user->getEmail(),
            $request->getPassword(),
            $request->getPasswordConfirmation()
        );

        $user->setPassword(Password::from($request->getPassword()));

        $this->user_repository->persist($user);
    }
}
