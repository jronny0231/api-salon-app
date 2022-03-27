<?php
    namespace App\Controladores\HTTP;

    use App\Controladores\Control\Controlador;
    use App\Controladores\Control\EMensajes;
    use App\Controladores\Control\Respuesta;
    use SRC\Route\SRC\Request;
    use App\Modelos\Usuario;
use stdClass;

    /**
     * Clase de controlador
     */
    class Usuario_controlador extends Controlador{

        function __construct() {}

        public static function index() { 
            $lista = (array) (new Usuario())->get();
            $resp = (count($lista) > 0) ?
                new Respuesta(EMensajes::CORRECTO):
                new Respuesta(EMensajes::ERROR);
            $resp->setDatos($lista);
            return $resp; 
        }

        public static function insertarUsuario(Array $Usuario) {
            $id = (new Usuario())->insert($Usuario);
            $resp = ($id > 0) ?
                new Respuesta(EMensajes::INSERCION_EXITOSA):
                new Respuesta(EMensajes::ERROR_INSERCION);
            $resp->setDatos($id);
            return $resp;
        }

        public static function listarUsuarios() {
            $select = "`usuario`.`id_usuario` as `id`, `usuario`.`nombre` as `Nombre`, `usuario`.`correo` as `Correo`, `rol`.`descripcion` as `Perfil`";
            $lista = (array) (new Usuario())->select($select)
                                            ->join("`rol`","`rol`.`id_rol`","=","`usuario`.`id_rol`")->get();
            $resp = (count($lista) > 0) ?
                new Respuesta(EMensajes::CORRECTO):
                new Respuesta(EMensajes::ERROR);
            $resp->setDatos($lista);
            return $resp;
        }

        public static function vistaUsuarios(){
            return (new self)->view("listaUsuarios", [
                "titulo" => "Lista de Usuarios",
                "nombre" => "Nikii",
                "apellido" => "De Los Santos",
                "datos" => self::listarUsuarios()
            ]);
        }

        public static function vistaUsuarioPorId(int $id){
            return (new self)->view("listaUsuarios", [
                "titulo" => "Mostrar Usuario",
                "nombre" => "Ronny",
                "apellido" => "Martinez Valdez",
                "datos" => self::buscarPorId($id)
            ]);
        }

        public static function actualizarUsuario(Array $usuario){
            if(!isset($usuario["id_usuario"])){
                return [
                    "code" => "500",
                    "msg" => "<b>Error al actualizar usuario:</b> no se ha recibido el campo 'id_usuario'",
                    "data" => null
                ];
            } 
            $actualizados = (new Usuario())->where("id_usuario","=", $usuario["id_usuario"])
                                            ->update($usuario);
            $resp = ($actualizados > 0) ?
                new Respuesta(EMensajes::ACTUALIZACION_EXITOSA):
                new Respuesta(EMensajes::ERROR_ACTUALIZACION);
            $resp->setDatos($actualizados);
            return $resp;
          
        }

        public static function eliminarUsuario(int $id_usuario){
            $eliminado = (new Usuario())->where("id_usuario","=", $id_usuario)
                                            ->delete();
            $resp = ($eliminado > 0) ?
                new Respuesta(EMensajes::ELIMINACION_EXITOSA):
                new Respuesta(EMensajes::ERROR);
            $resp->setDatos($eliminado);
            return $resp;
        }

        public static function buscarPorId(int $id_usuario){
            $usuario = (new Usuario())->where("id_usuario", "=", $id_usuario)
                                    ->first();
            $resp = (count((array)$usuario) > 0) ?
                new Respuesta(EMensajes::CORRECTO):
                new Respuesta(EMensajes::ERROR);
            $resp->setDatos($usuario);
            return $resp;
        }
    }
?>