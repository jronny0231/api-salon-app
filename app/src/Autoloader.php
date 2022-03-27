<?php

    /*
    class Autoloader {

        public static function registrar() {
            if (function_exists('__autoload')) {
                spl_autoload_register('__autoload');
                return;
            }

            if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
                spl_autoload_register(array('Autoloader', 'cargar'), true, true);
            } else {
                spl_autoload_register(array('Autoloader', 'cargar'));
            }
        }

        public static function cargar($clase){
            $nombreArchivo = $clase . '.php';
            $carpetas = require PATCH_CONFIG . 'autoloader.php';
            foreach ($carpetas as $carpeta) {
                if(self::buscarArchivo($carpeta, $nombreArchivo)) {
                    return true;
                }
            }

            return false;
        }

        private static function buscarArchivo($carpeta, $nombreArchivo) {
            $archivos = scandir($carpeta);
            foreach ($archivos  as $archivo) {
                $rutaArchivo = realpath($carpeta . DIRECTORY_SEPARATOR . $archivo);
                if (is_file($rutaArchivo)) {
                    if ($nombreArchivo == $archivo) {
                        require_once $rutaArchivo;
                        return true;
                    }
                } else if($archivo != '.' && $archivo != '..') {
                    return self::buscarArchivo($rutaArchivo, $nombreArchivo);
                }
            }
            return false;
        }
    }

    */

    function autoload($class) {

        //cargador del directorio de la aplicacion
        //¿por que doble diagonal? por proposito de escapar
        $prefix = 'App\\';

        //hace que la clase use el prefijo App
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            //busca en el directorio de proveedores

            //reemplaza el namespace con el separator de directorios Windows
            $file = VENDOR_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

            //si el archivo existe, lo requiere
            if (file_exists($file)) {
                require $file;
            }

            return;
        }

        $relativeClass = substr($class, $len);

        //remplaza el namespace con el separador de directorios Windows
        $file = APP_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

        //si el archivo existe, lo requiere
        if(file_exists($file)) {
            require $file;
        }
    }

    spl_autoload_register('autoload');


?>