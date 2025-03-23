<?php

namespace App\Modules\Auth\Core\Application\Services\Register;

use App\Modules\Auth\Core\Domain\Models\User\User;
use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;

class RegisterService
{
    public function __construct(private UserRepository $user_repository) {}

    public function execute(RegisterRequest $request): void
    {
        $user = User::create(
            $request->getName(),
            $request->getUsername(),
            new Email($request->getEmail()),
            Password::from($request->getPassword()),
        );

        $this->user_repository->persist($user);
    }
}
