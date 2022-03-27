<?php

    use SRC\Route\Route;

    require('./app/src/Roots.php');
    require(PATCH_SRC . 'Autoloader.php');

    new App\Routes\Web();
    new App\Routes\Api();

    Route::submit();

    /*
    $rutas = scandir(PATCH_ROUTES);

    foreach ($rutas as $archivo) {
        $rutaArchivo = realpath(PATCH_ROUTES . $archivo);
        if (is_file($rutaArchivo)) {
            require $rutaArchivo;
        }
    }
    */
