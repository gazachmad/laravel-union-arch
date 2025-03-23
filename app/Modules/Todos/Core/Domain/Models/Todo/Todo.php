<?php

namespace App\Modules\Todos\Core\Domain\Models\Todo;

use App\Modules\Shared\Model\DateTime;

class Todo
{
    public function __construct(
        private TodoId $id,
        private string $title,
        private string $description,
        private bool $completed,
        private DateTime $created_at,
        private ?DateTime $updated_at
    ) {}

    public static function create(
        string $title,
        string $description,
        bool $completed,
    ): Todo {
        return new Todo(
            TodoId::generate(),
            $title,
            $description,
            $completed,
            new DateTime(),
            null
        );
    }

    public function getId(): TodoId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
