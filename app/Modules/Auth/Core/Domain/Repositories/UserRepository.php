<?php

namespace App\Modules\Auth\Core\Domain\Repositories;

use App\Modules\Auth\Core\Domain\Models\User\User;
use App\Modules\Auth\Core\Domain\Models\User\UserId;
use App\Modules\Shared\Model\Email;

interface UserRepository
{
    public function persist(User $user);

    public function findByUsername(string $username): ?User;

    public function findByEmail(Email $email): ?User;

    public function findById(UserId $id): ?User;

    public function delete(User $user): void;
}
