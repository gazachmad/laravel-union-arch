<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodo;

class GetTodoRequest
{
    public function __construct(private string $id) {}

    public function getId(): string
    {
        return $this->id;
    }
}
