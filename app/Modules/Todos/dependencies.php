<?php

use App\Modules\Shared\Mechanism\UnitOfWork;
use App\Modules\Todos\Core\Domain\Repositories\TodoRepository;
use App\Modules\Todos\Infrastructure\Repositories\SqlTodoRepository;
use App\Modules\Todos\Presentation\Controllers\TodoController;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

App::singleton(TodoRepository::class, SqlTodoRepository::class);

App::when([
    // Repository
    SqlTodoRepository::class,

    // Service

])
    ->needs(ConnectionInterface::class)
    ->give(fn() => DB::connection('todos'));

App::when([
    // Controller
    TodoController::class,

    // Event Listener

    // Message Processor

    // Service

])
    ->needs(UnitOfWork::class)
    ->give(fn() => UnitOfWork::newInstance(DB::connection('todos')));
