<?php

namespace App\Modules\Todos\Core\Application\Services\DeleteTodo;

use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;
use App\Modules\Todos\Core\Domain\Repositories\TodoRepository;
use Exception;

class DeleteTodoService
{
    public function __construct(private TodoRepository $todo_repository) {}

    public function execute(DeleteTodoRequest $request): void
    {
        $todo = $this->todo_repository->find(new TodoId($request->getId()));

        if (!$todo) {
            throw new Exception('Todo not found');
        }

        $this->todo_repository->delete($todo);
    }
}
