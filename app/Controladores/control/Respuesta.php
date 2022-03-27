<?php
    namespace App\Controladores\Control;

use Exception;

    /**
     * Clase de gestion de funciones avanzadas para los controladores
     */
    class Respuesta extends Validador{
        
        public $codigo;
        public $mensaje;
        public $datos;

        function __construct($codigo = null, $mensaje = null, $datos = null) {
            if(isset($codigo) && empty($mensaje)){
                $respuesta = EMensajes::getMensaje($codigo);
                $this->codigo = $respuesta->codigo;
                $this->mensaje = $respuesta->mensaje;
                $this->datos = $respuesta->datos;
                return;
            }

            if(is_string($codigo)) {
                $temp = EMensajes::getMensaje($codigo);
                $codigo = $temp->codigo;
            }

            $this->codigo = $codigo;
            $this->mensaje = $mensaje;
            $this->datos = $datos;
        }

        public function json($obj = null) {
            header('Content-Type: application/json');
            if(is_array($obj) || is_object($obj)){
                return json_encode($obj);
            }
            return json_encode($this);
        }

        /**
         * Get the value of codigo
         */ 
        public function getCodigo()
        {
                return $this->codigo;
        }

        /**
         * Set the value of codigo
         *
         * @return  self
         */ 
        public function setCodigo($codigo)
        {
                $this->codigo = $codigo;

                return $this;
        }

        /**
         * Get the value of mensaje
         */ 
        public function getMensaje()
        {
                return $this->mensaje;
        }

        /**
         * Set the value of mensaje
         *
         * @return  self
         */ 
        public function setMensaje($mensaje)
        {
                $this->mensaje = $mensaje;

                return $this;
        }

        /**
         * Get the value of datos
         */ 
        public function getDatos()
        {
                return $this->datos;
        }

        /**
         * Set the value of datos
         *
         * @return  self
         */ 
        public function setDatos($datos)
        {
                $this->datos = $datos;

                return $this;
        }

        public function __get($key){
            if(isset($this->datos[$key])){
                return $this->datos[$key];
            }

            return new Exception("Error, campo {$key} no existe");
        }

        public function __set($key, $value){
            $this->datos[$key] = $value;
        }
    }

?>