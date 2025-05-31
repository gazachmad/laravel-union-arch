<?php

namespace App\Modules\IAM\Core\Domain\Models\User;

use App\Modules\Shared\Model\DateTime;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;
use App\Modules\Shared\Model\PhoneNumber;

class User
{
    public function __construct(
        private UserId $id,
        private string $name,
        private PhoneNumber $phone_number,
        private Email $email,
        private Password $password,
        private DateTime $created_at,
    ) {}

    public static function create(
        string $name,
        PhoneNumber $phone_number,
        Email $email,
        Password $password,
    ): User {
        return new User(
            UserId::generate(),
            $name,
            $phone_number,
            $email,
            $password,
            new DateTime(),
        );
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phone_number;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}
