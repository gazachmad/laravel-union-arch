<?php

namespace App\Modules\Todos\Core\Application\Services\GetTodos;

use App\Modules\Shared\Model\Filter;
use App\Modules\Todos\Core\Domain\Repositories\TodoRepository;

class GetTodosService
{
    public function __construct(private TodoRepository $todo_repository) {}

    public function execute(GetTodosRequest $request): GetTodosResponse
    {
        $offset = ($request->getPage() - 1) * $request->getPerPage();

        $paginated_todos = $this->todo_repository->getAllPaginated(
            new Filter(
                $request->getSearchText(),
                $request->getPerPage(),
                $offset,
            )
        );

        return new GetTodosResponse(
            collect($paginated_todos->getItems())
                ->map(fn($todo) => new ItemResponse(
                    $todo->getId(),
                    $todo->getTitle(),
                    $todo->getDescription(),
                    $todo->isCompleted(),
                    $todo->getCreatedAt(),
                    $todo->getUpdatedAt(),
                ))
                ->all(),
            $paginated_todos->getTotal(),
            $request->getPerPage(),
            $request->getPage(),
            $request->getPath(),
        );
    }
}
