<?php

use App\Modules\IAM\Core\Domain\Repositories\UserRepository;
use App\Modules\IAM\Core\Domain\Services\AuthService;
use App\Modules\IAM\Infrastructure\Repositories\SqlUserRepository;
use App\Modules\IAM\Infrastructure\Services\LaravelAuthService;
use App\Modules\IAM\Presentation\Controllers\AuthController;
use App\Modules\Shared\Mechanism\UnitOfWork;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

App::singleton(UserRepository::class, SqlUserRepository::class);

App::bind(AuthService::class, LaravelAuthService::class);

App::when([
    // Repository
    SqlUserRepository::class,

    // Service

])
    ->needs(ConnectionInterface::class)
    ->give(fn() => DB::connection('iam'));

App::when([
    // Controller
    AuthController::class,

    // Event Listener

    // Message Processor

    // Service

])
    ->needs(UnitOfWork::class)
    ->give(fn() => UnitOfWork::newInstance(DB::connection('iam')));