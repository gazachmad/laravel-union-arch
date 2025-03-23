<?php

namespace App\Modules\Todos\Core\Application\Services\CreateTodo;

use App\Modules\Todos\Core\Domain\Models\Todo\Todo;
use App\Modules\Todos\Core\Domain\Repositories\Todo\TodoRepository;

class CreateTodoService
{
    public function __construct(private TodoRepository $todo_repository) {}

    public function execute(CreateTodoRequest $request): void
    {
        $todo = Todo::create(
            $request->getTitle(),
            $request->getDescription(),
            $request->isCompleted()
        );

        $this->todo_repository->persist($todo);
    }
}
