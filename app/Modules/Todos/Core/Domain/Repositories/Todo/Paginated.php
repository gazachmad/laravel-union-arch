<?php

namespace App\Modules\Todos\Core\Domain\Repositories\Todo;

use App\Modules\Todos\Core\Domain\Models\Todo\Todo;

class Paginated
{
    /** @param Todo[] $items */
    public function __construct(
        private array $items,
        private int $total
    ) {}

    /** @return Todo[] */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
