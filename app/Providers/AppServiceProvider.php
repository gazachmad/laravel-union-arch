<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $cacheFile = base_path('bootstrap/cache/module-dependencies.php');
        if (file_exists($cacheFile)) {
            require $cacheFile;
            return;
        }

        foreach (scandir($path = app_path('Modules')) as $dir) {
            if (file_exists($filePath = "{$path}/{$dir}/dependencies.php")) {
                require $filePath;
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $cacheFile = base_path('bootstrap/cache/module-viewnamespace.php');
        if (file_exists($cacheFile)) {
            require $cacheFile;
            return;
        }

        foreach (scandir($path = app_path('Modules')) as $dir) {
            if (file_exists($folderPath = "{$path}/{$dir}/Presentation/views")) {
                View::addNamespace($dir, $folderPath);
            }
        }
    }
}
