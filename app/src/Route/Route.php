<?php

    namespace SRC\Route;

    use SRC\Route\SRC\URI;

    class Route {

        public function __construct() {

        }

        private static $uris = array();

        public static function add(String $htmlMethod, $uri, $callback = null) {
            Route::$uris[] = new URI(self::parseURI($uri), $htmlMethod, $callback);

            //Retorna un Middleware
            return;
        }

        /**
         * Metodo GET del CRUD para obtener datos;
         * @param uri es la seccion de la url a la que hace referencia el get
         * @param function es la referencia de la clase a usar
         * @param method es el metodo de la clase al que haremos referencia, por defecto [index] 
         */
        public static function get($uri, $callback = null) {
            return Route::add("GET", $uri, $callback);
        }
    
        /**
         * Metodo para adicionar datos;
         */
        public static function post($uri, $callback = null) {
            return Route::add("POST", $uri, $callback);
        }

        /**
         * Metodo para actualizar datos;
         */
        public static function put($uri, $callback = null) {
            return Route::add("PUT", $uri, $callback);
        }

        /**
         * Metodo para eliminar datos
         */
        public static function delete($uri, $callback = null) {
            return Route::add("DELETE", $uri, $callback);
        }

        public static function any($uri, $callback = null) {
            return Route::add("ANY", $uri, $callback);
        }

        public static function submit() {
            $htmlMethod = $_SERVER['REQUEST_METHOD'];
            $uri = isset($_GET['uri']) ? $_GET['uri'] : '';
            $uri = self::parseURI($uri);

            //Verifica si la uri que esta pidiendo el usuario se encuentra registrada
            foreach (Route::$uris as $key => $recordURI) {
                if($recordURI->match($uri)) {
                    return $recordURI->call();
                }
            }

            //Muestra el mensaje de error 404
            header("Content-Type: text/html");
            echo 'La uri (<a href="' . $uri . '">' . $uri . '</a>) no se encuentra registrada en el metodo ' . $htmlMethod . '.'; 
        }

        private static function parseURI($uri) {
            $uri = trim($uri, '/');
            $uri = (strlen($uri) > 0) ? $uri : '/';
            return $uri;
        }
    }

?>