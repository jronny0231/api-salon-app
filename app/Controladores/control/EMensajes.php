<?php

    namespace App\Controladores\Control;

    class EMensajes {

        const CORRECTO = "CORRECTO";
        const INSERCION_EXITOSA = "INSERCION_EXITOSA";
        const ACTUALIZACION_EXITOSA = "ACTUALIZACION_EXITOSA";
        const ELIMINACION_EXITOSA = "ELIMINACION_EXITOSA";

        const ERROR = "ERROR";
        const ERROR_INSERCION = "ERROR_INSERCION";
        const ERROR_ACTUALIZACION = "ERROR_ACTUALIZACION";

        public static function getMensaje($codigo) {
            switch($codigo) {
                case EMensajes::CORRECTO:
                    return new Respuesta(100, "Se ha realizado la operacion de manera correcta.");
                case EMensajes::INSERCION_EXITOSA:
                    return new Respuesta(100, "Se ha insertado el registro con exito.");
                case EMensajes::ACTUALIZACION_EXITOSA:
                    return new Respuesta(100, "Se ha actualizado el registro con exito.");
                case EMensajes::ELIMINACION_EXITOSA:
                    return new Respuesta(100, "Se ha eliminado el registro con exito.");


                case EMensajes::ERROR:
                    return new Respuesta(400, "Se ha producido un error al realizar la operacion.");
                case EMensajes::ERROR_INSERCION:
                    return new Respuesta(400, "Se ha producido un error al insertar el registro.");
                case EMensajes::ERROR_ACTUALIZACION:
                    return new Respuesta(400, "Se ha producido un error al actualizar el registro.");
            }
        }
    }

?>