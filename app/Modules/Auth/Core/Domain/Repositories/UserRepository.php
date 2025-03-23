<?php

namespace App\Modules\Auth\Core\Domain\Repositories;

use App\Modules\Auth\Core\Domain\Models\User\User;
use App\Modules\Auth\Core\Domain\Models\User\UserId;

interface UserRepository
{
    public function persist(User $user);

    public function findByUsername(string $username): ?User;

    public function findById(UserId $id): ?User;

    public function delete(User $user): void;
}
