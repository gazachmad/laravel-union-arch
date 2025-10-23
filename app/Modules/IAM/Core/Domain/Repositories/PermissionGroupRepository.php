<?php

namespace App\Modules\IAM\Core\Domain\Repositories;

use App\Modules\IAM\Core\Domain\Models\PermissionGroup\PermissionGroup;
use App\Modules\IAM\Core\Domain\Models\PermissionGroup\PermissionGroupId;
use App\Modules\Shared\Model\DataPaginated;
use App\Modules\Shared\Model\Filter;

interface PermissionGroupRepository
{
    public function findById(PermissionGroupId $id): ?PermissionGroup;

    /** @return DataPaginated<PermissionGroup> */
    public function getAllPaginated(Filter $filter);

    public function persist(PermissionGroup $permission_group): void;

    public function delete(PermissionGroup $permission_group): void;
}
