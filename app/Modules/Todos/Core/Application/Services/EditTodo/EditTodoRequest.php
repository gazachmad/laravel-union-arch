<?php

namespace App\Modules\Todos\Core\Application\Services\EditTodo;

class EditTodoRequest
{
    public function __construct(
        private string $id,
        private string $title,
        private string $description,
        private bool $completed
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

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
