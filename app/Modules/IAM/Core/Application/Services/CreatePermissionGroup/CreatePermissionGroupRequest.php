<?php

namespace App\Modules\IAM\Core\Application\Services\CreatePermissionGroup;

class CreatePermissionGroupRequest
{
    public function __construct(
        private string $name,
        private string $permission_flag
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPermissionFlag(): string
    {
        return $this->permission_flag;
    }
}
