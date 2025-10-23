<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodo;

use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;
use App\Modules\Todos\Core\Domain\Repositories\TodoRepository;
use Exception;

class GetTodoService
{
    public function __construct(private TodoRepository $todo_repository) {}

    public function execute(GetTodoRequest $request): GetTodoResponse
    {
        $todo = $this->todo_repository->find(new TodoId($request->getId()));

        if (!$todo) {
            throw new Exception('Todo not found');
        }

        return new GetTodoResponse(
            $todo->getId(),
            $todo->getTitle(),
            $todo->getDescription(),
            $todo->isCompleted(),
            $todo->getCreatedAt(),
            $todo->getUpdatedAt(),
        );
    }
}
