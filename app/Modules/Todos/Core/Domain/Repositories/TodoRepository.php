<?php

namespace App\Modules\Todos\Core\Domain\Repositories;

use App\Modules\Shared\Model\DataPaginated;
use App\Modules\Shared\Model\Filter;
use App\Modules\Todos\Core\Domain\Models\Todo\Todo;
use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;

interface TodoRepository
{
    public function find(TodoId $id): ?Todo;

    /** @return DataPaginated<Todo> */
    public function getAllPaginated(Filter $filter);

    public function persist(Todo $todo): void;

    public function delete(Todo $todo): void;
}
