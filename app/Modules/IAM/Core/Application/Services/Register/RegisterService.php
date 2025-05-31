<?php

namespace App\Modules\IAM\Core\Application\Services\Register;

use App\Modules\IAM\Core\Domain\Models\User\User;
use App\Modules\IAM\Core\Domain\Repositories\UserRepository;
use App\Modules\IAM\Core\Domain\Services\AuthService;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;
use App\Modules\Shared\Model\PhoneNumber;

class RegisterService
{
    public function __construct(
        private UserRepository $user_repository,
        private AuthService $auth_service
    ) {}

    public function execute(RegisterRequest $request): void
    {
        $user = User::create(
            $request->getName(),
            new PhoneNumber($request->getPhoneNumber()),
            new Email($request->getEmail()),
            Password::from($request->getPassword()),
        );

        $this->user_repository->persist($user);

        $this->auth_service->attempt(
            $user->getPhoneNumber(),
            $request->getPassword(),
            false,
        );
    }
}
