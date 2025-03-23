<?php

use App\Modules\Shared\Mechanism\EventManager;
use Illuminate\Support\Facades\App;

App::singleton(EventManager::class, fn() => new EventManager());

// App::singleton(MessageBus::class, function () {
//     $provider = config("messagebus.default");
//     $config = config("messagebus.connections.$provider");

//     if (!isset($config["driver"])) {
//         throw new Error("Please specify MessageBus driver in the config!");
//     }

//     switch ($driver = $config["driver"]) {
//         case "laravel":
//             return App::make(LaravelMessageBus::class, ['queue_name' => $config['queue']]);
//         default:
//             throw new Error("MessageBus $driver driver is not yet supported");
//     }
// });
