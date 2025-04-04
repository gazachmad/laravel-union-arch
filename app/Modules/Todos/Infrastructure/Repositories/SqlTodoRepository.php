<?php

namespace App\Modules\Todos\Infrastructure\Repositories;

use App\Modules\Shared\Model\DateTime;
use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;
use App\Modules\Todos\Core\Domain\Models\Todo\Todo;
use App\Modules\Todos\Core\Domain\Repositories\Todo\Filter;
use App\Modules\Todos\Core\Domain\Repositories\Todo\Paginated;
use App\Modules\Todos\Core\Domain\Repositories\Todo\TodoRepository;
use Illuminate\Database\ConnectionInterface;

class SqlTodoRepository implements TodoRepository
{
    public function __construct(private ConnectionInterface $db) {}

    public function find(TodoId $id): ?Todo
    {
        $row = $this->db->table('todos')
            ->where('id', '=', $id)
            ->first();

        return $row ? $this->construct($row) : null;
    }

    public function getAllPaginated(Filter $filter): Paginated
    {
        $query = $this->db->table('todos');

        if ($filter->getSearchText()) {
            $query->where('title', 'like', '%' . $filter->getSearchText() . '%');
        }

        $total = $query->count();

        $rows = $query->limit($filter->getLimit())
            ->offset($filter->getOffset())
            ->orderByDesc('updated_at')
            ->orderByDesc('created_at')
            ->get();

        return new Paginated(
            collect($rows)
                ->map(fn($row) => $this->construct($row))
                ->all(),
            $total,
        );
    }

    public function persist(Todo $todo): void
    {
        $this->db->table('todos')
            ->upsert($this->destruct($todo), 'id');
    }

    public function delete(Todo $todo): void
    {
        $this->db->table('todos')
            ->where('id', '=', $todo->getId())
            ->delete();
    }

    private function construct(mixed $row): Todo
    {
        return new Todo(
            new TodoId($row->id),
            $row->title,
            $row->description,
            $row->completed,
            new DateTime('@' . $row->created_at),
            $row->updated_at ? new DateTime('@' . $row->updated_at) : null,
        );
    }

    /** @return array<string, mixed> */
    private function destruct(Todo $todo): array
    {
        return [
            'id' => $todo->getId(),
            'title' => $todo->getTitle(),
            'description' => $todo->getDescription(),
            'completed' => $todo->isCompleted(),
            'created_at' => $todo->getCreatedAt()->getTimestamp(),
            'updated_at' => $todo->getUpdatedAt()?->getTimestamp(),
        ];
    }
}
