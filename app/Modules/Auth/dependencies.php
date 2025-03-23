<?php

use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use App\Modules\Auth\Core\Domain\Services\AuthenticateService;
use App\Modules\Auth\Infrastructure\Repositories\SqlUserRepository;
use App\Modules\Auth\Infrastructure\Services\LaravelAuthenticateService;
use Illuminate\Support\Facades\App;

App::singleton(UserRepository::class, SqlUserRepository::class);

App::bind(AuthenticateService::class, LaravelAuthenticateService::class);
