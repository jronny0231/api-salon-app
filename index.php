<?php
    
    require_once('./app/src/launcher.php');;



    /*
    use App\Controladores\Usuario_controlador;

    function getData(){
        $data[0] = "<pre>";
        $data[1] = (new Usuario_controlador)->buscarPorId(6);
        $data[2] = "</pre>";

        return $data;
    }

    function newData(){
        $data = [
            "nombre" => "El viejo Liopo",
            "correo" => "viejevo@hotmail.com",
            "username" => "viejo01",
            "clave_encrypt" => md5("pitufina02"),
            "id_rol" => 3
        ];
        $result = (new Usuario_controlador)->insertarUsuario($data);
        return $result;
    }

    function updateData(){
        $data = [
            "id_usuario" => 1,
            "nombre" => "Juan Carlos Sanchez Manzueta",
            "correo" => "juancdmanzueta@hotmail.com"
        ];

        $result = (new Usuario_controlador)->actualizarUsuario($data);
        return $result;
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Public/assets/css/styles.css">
    <script src="Public/assets/js/main.js"></script>

    <title>Acceso al sistema</title>
</head>
<body>
    <div class="container bg">
        <div class="header">
        </div>
        <div class="main">
            <?=   
                    //print_r(updateData());
                    print_r(getData());
            ?>
        </div>
        <div class="footer">
            
        </div>
    </div>
</body>
</html>


*/