<?php

namespace App\Modules\Auth\Infrastructure\Repositories;

use App\Modules\Auth\Core\Domain\Models\User\User;
use App\Modules\Auth\Core\Domain\Models\User\UserId;
use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Shared\Model\DateTime;
use App\Modules\Shared\Model\Email;
use App\Modules\Shared\Model\Password;
use App\Modules\Shared\Model\PhoneNumber;
use Illuminate\Database\ConnectionInterface;

class SqlUserRepository implements UserRepository
{
    public function __construct(private ConnectionInterface $db) {}

    public function persist(User $user)
    {
        $this->db->table('users')
            ->upsert($this->destruct($user), 'id');
    }

    public function findByPhoneNumber(PhoneNumber $phone_number): ?User
    {
        $user = $this->db->table('users')
            ->where('phone_number', '=', $phone_number)
            ->first();

        return $user ? $this->construct($user) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $user = $this->db->table('users')
            ->where('email', '=', $email)
            ->first();

        return $user ? $this->construct($user) : null;
    }

    public function findById(UserId $id): ?User
    {
        $user = $this->db->table('users')
            ->where('id', '=', $id)
            ->first();

        return $user ? $this->construct($user) : null;
    }

    public function delete(User $user): void
    {
        $this->db->table('users')
            ->where('id', '=', $user->getId())
            ->delete();
    }

    private function construct(mixed $row): User
    {
        return new User(
            new UserId($row->id),
            $row->name,
            new PhoneNumber($row->phone_number),
            new Email($row->email),
            new Password($row->password),
            new DateTime('@' . $row->created_at),
            $row->updated_at ? new DateTime('@' . $row->updated_at) : null
        );
    }

    /** @return array<string, mixed> */
    private function destruct(User $user): array
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'phone_number' => $user->getPhoneNumber(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'created_at' => $user->getCreatedAt()->getTimestamp(),
            'updated_at' => $user->getUpdatedAt()?->getTimestamp(),
        ];
    }
}
