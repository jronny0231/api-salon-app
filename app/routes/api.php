<?php
    namespace App\Routes;

    use App\Controladores\HTTP\Usuario_controlador;
    use SRC\Route\Route;

    class Api {

        public function __construct(){
            Route::get("/api/Usuarios", [Usuario_controlador::class, "listarUsuarios"]);
            Route::get('/api/Usuario/:id', [Usuario_controlador::class, "buscarPorId"]);
        }
    }

?>