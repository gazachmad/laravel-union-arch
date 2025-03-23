<?php

namespace App\Modules\Todos\Core\Application\Services\DeleteTodo;

class DeleteTodoRequest
{
    public function __construct(private string $id) {}

    public function getId(): string
    {
        return $this->id;
    }
}
