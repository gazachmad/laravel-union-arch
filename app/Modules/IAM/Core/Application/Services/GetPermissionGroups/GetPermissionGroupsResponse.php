<?php

namespace App\Modules\IAM\Core\Application\Services\GetPermissionGroups;

use Illuminate\Pagination\LengthAwarePaginator;

// @phpstan-ignore-next-line
class GetPermissionGroupsResponse extends LengthAwarePaginator
{
    /** @param ItemResponse[] $items */
    public function __construct(
        array $items,
        int $total,
        int $per_page,
        int $current_page,
        string $path
    ) {
        parent::__construct(
            $items,
            $total,
            $per_page,
            $current_page,
            ['path' => $path]
        );
    }
}
