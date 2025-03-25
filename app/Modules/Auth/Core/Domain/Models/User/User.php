<?php

namespace App\Modules\Auth\Core\Domain\Models\User;

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
        private ?DateTime $updated_at
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

    public function getInitial(): string
    {
        preg_match_all('#(?<=\s|\b)\pL#u', $this->name, $res);
        $initials = implode('', $res[0]);

        if (strlen($initials) < 2) {
            $initials = substr($this->name, 0, 2);
        } else {
            $initials = substr($initials, 0, 2);
        }

        return strtoupper($initials);
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

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }
}
