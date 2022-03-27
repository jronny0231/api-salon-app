<?php
    namespace App\Routes;

use App\Bin\View;
use App\Controladores\HTTP\Usuario_controlador;
use SRC\Route\Route;
    use SRC\Route\SRC\Request;

    class Web {

        function __construct() {

            Route::get('/Usuarios', [Usuario_controlador::class, "vistaUsuarios"]);
            
            Route::get('/Usuario/:id', [Usuario_controlador::class, "vistaUsuarioPorId"]);

            Route::get('/', function(Request $req) {
                $home = new View("home.php");
                $home->title = "Pagina Principal";
                $home->head = "Pagina Principal del Sitio Web";
                $home->subhead = "ESTA PAGINA ESTA CONSTRUIDA EN PHP EN LA ARQUITECTURA MVC";
                $home->content = "MVC (Modelo-Vista-Controlador) es un patrón en el diseño de software 
                                    comúnmente utilizado para implementar interfaces de usuario,
                                    datos y lógica de control. Enfatiza una separación entre la lógica de negocios 
                                    y su visualización.";
                $home->actionSrc = "/testing_projects/salon_app/Usuarios";
                $home->actionBtn = "Ver Usuarios";
                return $home->render();
            });
        }
    }
?>