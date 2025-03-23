<?php

use App\Modules\Todos\Core\Domain\Repositories\Todo\TodoRepository;
use App\Modules\Todos\Infrastructure\Repositories\SqlTodoRepository;
use Illuminate\Support\Facades\App;

App::singleton(TodoRepository::class, SqlTodoRepository::class);

// App::when([
//     // Repository

//     // Service

// ])->needs(ConnectionInterface::class)->give(fn () => DB::connection('sqlite'));

// App::when([
//     // Controller

//     // Event Listener

//     // Message Processor

//     // Service

// ])->needs(UnitOfWork::class)->give(fn () => UnitOfWork::newInstance(DB::connection('sqlite')));
