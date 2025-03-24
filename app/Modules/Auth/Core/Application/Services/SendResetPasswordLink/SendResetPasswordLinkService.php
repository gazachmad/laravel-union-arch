<?php

namespace App\Modules\Auth\Core\Application\Services\SendResetPasswordLink;

use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use App\Modules\Shared\Model\Email;
use Exception;

class SendResetPasswordLinkService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthenticateService $authenticate_service
    ) {}

    public function execute(SendResetPasswordLinkRequest $request): void
    {
        $user = $this->user_repository->findByEmail(new Email($request->getEmail()));

        if (!$user) {
            throw new Exception('User not found');
        }

        $this->authenticate_service->sendResetPasswordLink($user->getEmail());
    }
}
