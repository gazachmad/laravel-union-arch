<?php

namespace App\Modules\IAM\Infrastructure\Repositories;

use App\Modules\IAM\Core\Domain\Models\PermissionGroup\PermissionGroupId;
use App\Modules\IAM\Core\Domain\Models\PermissionGroup\PermissionGroup;
use App\Modules\IAM\Core\Domain\Repositories\PermissionGroupRepository;
use App\Modules\Shared\Model\DataPaginated;
use App\Modules\Shared\Model\Filter;
use App\Modules\Shared\Model\Permission;
use Illuminate\Database\ConnectionInterface;
use phpseclib3\Math\BigInteger;

class SqlPermissionGroupRepository implements PermissionGroupRepository
{
    public function __construct(private ConnectionInterface $db) {}

    public function findById(PermissionGroupId $id): ?PermissionGroup
    {
        $row = $this->db->table('permission_groups')
            ->where('id', $id)
            ->first();

        return $row ? $this->construct($row) : null;
    }

    public function getAllPaginated(Filter $filter)
    {
        $query = $this->db->table('permission_groups');

        if ($filter->getSearchText()) {
            $query->where('name', 'like', '%' . $filter->getSearchText() . '%');
        }

        $total = $query->count();

        $rows = $query->limit($filter->getLimit())
            ->offset($filter->getOffset())
            ->orderBy('name')
            ->get();

        return new DataPaginated(
            collect($rows)
                ->map(fn($row) => $this->construct($row))
                ->all(),
            $total,
        );
    }

    public function persist(PermissionGroup $permission_group): void
    {
        $this->db->table('permission_groups')
            ->upsert($this->destruct($permission_group), 'id');
    }

    public function delete(PermissionGroup $permission_group): void
    {
        $this->db->table('permission_groups')
            ->where('id', $permission_group->getId())
            ->delete();
    }

    private function construct(mixed $row): PermissionGroup
    {
        return new PermissionGroup(
            new PermissionGroupId($row->id),
            $row->name,
            new Permission($row->permission_version, new BigInteger(base64_decode($row->permission_flag), 256)),
        );
    }

    /** @return array<string, mixed> */
    private function destruct(PermissionGroup $permission_group): array
    {
        return [
            'id' => $permission_group->getId(),
            'name' => $permission_group->getName(),
            'permission_version' => $permission_group->getPermission()->getVersion(),
            'permission_flag' => base64_encode($permission_group->getPermission()->getFlag()->toBytes()),
        ];
    }
}
