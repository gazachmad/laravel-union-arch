<?php

namespace App\Modules\Todos\Core\Domain\Repositories\Todo;

use App\Modules\Todos\Core\Domain\Models\Todo\Todo;
use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;

interface TodoRepository
{
    public function find(TodoId $id): ?Todo;

    public function getAllPaginated(Filter $filter): Paginated;

    public function persist(Todo $todo): void;

    public function delete(Todo $todo): void;
}
