<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodos;

class GetTodosRequest
{
    public function __construct(
        private ?string $search_text,
        private int $page,
        private int $per_page,
        private string $path,
    ) {}

    public function getSearchText(): ?string
    {
        return $this->search_text;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->per_page;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
