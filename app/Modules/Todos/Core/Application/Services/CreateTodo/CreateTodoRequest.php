<?php

namespace App\Modules\Todos\Core\Application\Services\CreateTodo;

class CreateTodoRequest
{
    public function __construct(
        private string $title,
        private string $description,
        private bool $completed
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }
}
