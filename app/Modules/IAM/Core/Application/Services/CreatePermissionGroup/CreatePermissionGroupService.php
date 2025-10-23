<?php

namespace App\Modules\IAM\Core\Application\Services\CreatePermissionGroup;

use App\Modules\IAM\Core\Domain\Models\PermissionGroup\PermissionGroup;
use App\Modules\IAM\Core\Domain\Repositories\PermissionGroupRepository;

class CreatePermissionGroupService
{
    public function __construct(private PermissionGroupRepository $permission_group_repository) {}

    public function execute(CreatePermissionGroupRequest $request): void
    {
        $permission_group = PermissionGroup::create(
            $request->getName(),
            1,
            $request->getPermissionFlag()
        );

        $this->permission_group_repository->persist($permission_group);
    }
}
