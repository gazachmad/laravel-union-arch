<?php

namespace App\Modules\Todos\Core\Application\Services\EditTodo;

use App\Modules\Shared\Model\DateTime;
use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;
use App\Modules\Todos\Core\Domain\Repositories\Todo\TodoRepository;
use Exception;

class EditTodoService
{
    public function __construct(private TodoRepository $todo_repository) {}

    public function execute(EditTodoRequest $request): void
    {
        $todo = $this->todo_repository->find(new TodoId($request->getId()));

        if (!$todo) {
            throw new Exception('Todo not found');
        }

        $todo->setTitle($request->getTitle());
        $todo->setDescription($request->getDescription());
        $todo->setCompleted($request->isCompleted());
        $todo->setUpdatedAt(new DateTime());

        $this->todo_repository->persist($todo);
    }
}
