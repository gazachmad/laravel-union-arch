<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodos;

class GetTodosResponse
{
    public function __construct(
        /** @var ItemResponse[] $items */
        private array $items,
        private int $total
    ) {}

    /** @return ItemResponse[] */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
