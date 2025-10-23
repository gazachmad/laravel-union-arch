<?php

namespace App\Modules\IAM\Core\Application\Services\GetPermissionGroups;

use App\Modules\IAM\Core\Domain\Repositories\PermissionGroupRepository;
use App\Modules\Shared\Model\Filter;

class GetPermissionGroupsService
{
    public function __construct(private PermissionGroupRepository $permission_group_repository) {}

    public function execute(GetPermissionGroupsRequest $request): GetPermissionGroupsResponse
    {
        $offset = ($request->getPage() - 1) * $request->getPerPage();

        $paginated_permission_groups = $this->permission_group_repository->getAllPaginated(
            new Filter(
                $request->getSearchText(),
                $request->getPerPage(),
                $offset,
            )
        );

        return new GetPermissionGroupsResponse(
            collect($paginated_permission_groups->getItems())
                ->map(fn($permission_group) => new ItemResponse(
                    $permission_group->getId(),
                    $permission_group->getName(),
                ))
                ->all(),
            $paginated_permission_groups->getTotal(),
            $request->getPerPage(),
            $request->getPage(),
            $request->getPath(),
        );
    }
}
