<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodos;

use Illuminate\Pagination\LengthAwarePaginator;

class GetTodosResponse extends LengthAwarePaginator
{
    public function __construct(
        /** @var ItemResponse[] $items */
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
