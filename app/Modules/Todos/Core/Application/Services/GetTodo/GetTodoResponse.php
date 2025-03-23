<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodo;

use DateTime;

class GetTodoResponse
{
    public function __construct(
        private string $id,
        private string $title,
        private string $description,
        private bool $completed,
        private DateTime $created_at,
        private ?DateTime $updated_at
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

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }
}
