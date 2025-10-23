<?php

namespace App\Modules\Shared\Model;

class Filter
{
    public function __construct(
        private ?string $search_text,
        private int $limit,
        private int $offset
    ) {}

    public function getSearchText(): ?string
    {
        return $this->search_text;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
