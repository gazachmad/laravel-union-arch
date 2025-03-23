<?php

namespace App\Modules\Todos\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Shared\Mechanism\UnitOfWork;
use App\Modules\Todos\Core\Application\Services\CreateTodo\CreateTodoRequest;
use App\Modules\Todos\Core\Application\Services\CreateTodo\CreateTodoService;
use App\Modules\Todos\Core\Application\Services\DeleteTodo\DeleteTodoRequest;
use App\Modules\Todos\Core\Application\Services\DeleteTodo\DeleteTodoService;
use App\Modules\Todos\Core\Application\Services\EditTodo\EditTodoRequest;
use App\Modules\Todos\Core\Application\Services\EditTodo\EditTodoService;
use App\Modules\Todos\Core\Application\Services\GetTodo\GetTodoRequest;
use App\Modules\Todos\Core\Application\Services\GetTodo\GetTodoService;
use App\Modules\Todos\Core\Application\Services\GetTodos\GetTodosRequest;
use App\Modules\Todos\Core\Application\Services\GetTodos\GetTodosService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TodoController extends Controller
{
    public function __construct(private UnitOfWork $unit_of_work) {}

    public function index(Request $request, GetTodosService $service): View
    {
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 10);

        $paginated_todos = $service->execute(
            new GetTodosRequest(
                $request->input('q'),
                $page,
                $per_page
            )
        );

        $todos = new LengthAwarePaginator(
            $paginated_todos->getItems(),
            $paginated_todos->getTotal(),
            $per_page,
            $page,
            ['path' => $request->url()]
        );

        $data = [
            'title' => 'Todos',
            'slug' => 'todos',
            'todos' => $todos
        ];

        return view('Todos::todo.index', $data);
    }

    /** @return View|RedirectResponse */
    public function add(Request $request, CreateTodoService $service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new CreateTodoRequest(
                        $request->input('title'),
                        $request->input('description'),
                        $request->boolean('completed')
                    )
                ));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->route('todos.index')->with('alert.success', 'Todo created successfully');
        }

        $data = [
            'title' => 'Add Todo',
            'slug' => 'todos',
            'todo' => null
        ];

        return view('Todos::todo.edit', $data);
    }

    /** @return View|RedirectResponse */
    public function edit(Request $request, string $id, GetTodoService $service, EditTodoService $edit_service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $edit_service->execute(
                    new EditTodoRequest(
                        $id,
                        $request->input('title'),
                        $request->input('description'),
                        $request->boolean('completed')
                    )
                ));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->back()->with('alert.success', 'Todo updated successfully');
        }

        try {
            $todo = $service->execute(new GetTodoRequest($id));
        } catch (Exception $e) {
            return redirect()->route('todos.index')->with('alert.error', $e->getMessage());
        }

        $data = [
            'title' => 'Edit Todo',
            'slug' => 'todos',
            'todo' => $todo
        ];

        return view('Todos::todo.edit', $data);
    }

    public function delete(string $id, DeleteTodoService $service): RedirectResponse
    {
        try {
            $this->unit_of_work->transaction(fn() => $service->execute(
                new DeleteTodoRequest($id)
            ));
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
        }

        return redirect()->route('todos.index')->with('alert.success', 'Todo deleted successfully');
    }
}
