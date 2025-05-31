<?php

namespace App\Modules\IAM\Core\Domain\Models\PermissionGroup;

use App\Modules\Shared\Model\Permission;

class PermissionGroup
{
    public function __construct(
        private PermissionGroupId $id,
        private string $name,
        private Permission $permission,
    ) {}

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
