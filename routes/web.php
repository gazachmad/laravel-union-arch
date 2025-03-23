<?php

foreach (scandir($path = app_path('Modules')) as $dir) {
    if (file_exists($filePath = "{$path}/{$dir}/Presentation/routes/web.php")) {
        require $filePath;
    }
}
