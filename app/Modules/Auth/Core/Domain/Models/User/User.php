<?php

namespace App\Modules\Auth\Core\Domain\Models\User;

use App\Modules\Shared\Model\DateTime;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;

class User
{
    public function __construct(
        private UserId $id,
        private string $name,
        private string $username,
        private Email $email,
        private Password $password,
        private DateTime $created_at,
        private ?DateTime $updated_at
    ) {}

    public static function create(
        string $name,
        string $username,
        Email $email,
        Password $password,
    ): User {
        return new User(
            UserId::generate(),
            $name,
            $username,
            $email,
            $password,
            new DateTime(),
            null
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }
}
