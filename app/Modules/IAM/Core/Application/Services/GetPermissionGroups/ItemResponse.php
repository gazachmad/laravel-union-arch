<?php

namespace App\Modules\IAM\Core\Application\Services\GetPermissionGroups;

use App\Modules\Shared\Model\DateTime;
use App\Modules\Shared\Model\Permission;

class ItemResponse
{
    public function __construct(
        private string $id,
        private string $name,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
