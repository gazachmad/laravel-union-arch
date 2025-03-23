<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$commands = [];
$discoveredEvents = [];
foreach (scandir($path = __DIR__ . '/../app/Modules') as $dir) {
    if (file_exists($folderPath = "{$path}/{$dir}/Presentation/Commands")) {
        $commands[] = $folderPath;
    }
    if (file_exists($folderPath = "{$path}/{$dir}/Core/Application/EventListeners")) {
        $discoveredEvents[] = $folderPath;
    }
}

return Application::configure(basePath: dirname(__DIR__))
    ->withCommands($commands)
    ->withEvents($discoveredEvents)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
