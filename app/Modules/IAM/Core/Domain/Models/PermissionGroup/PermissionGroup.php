<?php

namespace App\Modules\IAM\Core\Domain\Models\PermissionGroup;

use App\Modules\Shared\Model\Permission;
use phpseclib3\Math\BigInteger;

class PermissionGroup
{
    public function __construct(
        private PermissionGroupId $id,
        private string $name,
        private Permission $permission,
    ) {}

    public static function create(string $name, int $permission_version, string $permission_flag)
    {
        return new PermissionGroup(
            PermissionGroupId::generate(),
            $name,
            new Permission($permission_version, new BigInteger(base64_decode($permission_flag), 256))
        );
    }

    public function getId(): PermissionGroupId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPermission(): Permission
    {
        return $this->permission;
    }
}
