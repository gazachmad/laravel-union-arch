<?php

namespace App\Modules\IAM\Core\Application\Services\SendResetPasswordLink;

use App\Modules\IAM\Core\Domain\Repositories\UserRepository;
use App\Modules\IAM\Core\Domain\Services\AuthService;
use App\Modules\Shared\Model\Email;
use Exception;

class SendResetPasswordLinkService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthService $auth_service
    ) {}

    public function execute(SendResetPasswordLinkRequest $request): void
    {
        $user = $this->user_repository->findByEmail(new Email($request->getEmail()));

        if (!$user) {
            throw new Exception('User not found');
        }

        $this->auth_service->sendResetPasswordLink($user->getEmail());
    }
}
