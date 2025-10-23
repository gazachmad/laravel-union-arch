<?php

namespace App\Modules\Shared\Model;

/**
 * @template T
 */
class DataPaginated
{
    /** @param T[] $items */
    public function __construct(
        private array $items,
        private int $total
    ) {}

    /** @return T[] */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
