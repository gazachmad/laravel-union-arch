<?php

namespace App\Modules\IAM\Core\Domain\Repositories;

use App\Modules\IAM\Core\Domain\Models\User\User;
use App\Modules\IAM\Core\Domain\Models\User\UserId;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\PhoneNumber;

interface UserRepository
{
    public function persist(User $user): void;

    public function findByPhoneNumber(PhoneNumber $phone_number): ?User;

    public function findByEmail(Email $email): ?User;

    public function findById(UserId $id): ?User;

    public function delete(User $user): void;
}
