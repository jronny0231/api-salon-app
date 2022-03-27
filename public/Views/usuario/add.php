<?php
    
    require_once(__DIR__."/../../modelos/Usuario.php");

    $objUsuario = new Modelos\Usuario();

    //Insertar usuario
    $new = $objUsuario->insertUsuario((Object)[
        'nombre' => 'Gregorio Luperon',
        'username' => 'gluperon',
        'correo' => 'gregluperon@hotmail.com',
        'clave_encrypt' => md5('gregpupu12'),
        'id_rol' => 2
    ]);
    echo "Nuevo ID: " . $new;

?>