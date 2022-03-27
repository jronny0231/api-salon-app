<?php
    namespace App\Controladores\Control;

    class Validador {

        public static function validar(Array $validar) {
            $instance = new Validador();
            foreach($validar as $campo => $cond){
                if(strpos($cond,"|") > 0){
                    foreach (explode("|",$cond) as $valor) {
                        return $instance->evaluador($campo, $valor);
                    }
                } else {
                    return $instance->evaluador($campo, $cond);
                }
            }
        }

        /**
         * Algoritmo que evalua si es una validacion de comparacion, existencia o duplicidad
         * Usa el filter_var para extraer el valor numerico dentro de un string;
         */
        private function evaluador(String $campo, String $cond) {
            $valorCond = filter_var($cond,FILTER_SANITIZE_NUMBER_INT);
                if ((strrpos($cond,">") !== false) && ($campo > $valorCond)){
                    return true;
                } elseif ((strrpos($cond,"<") !== false) && ($campo < $valorCond)){
                    return true;
                } elseif ((strrpos($cond,"=") !== false) && ($campo == $valorCond)){
                    return true;
                } elseif ((strrpos($cond,"Null") !== false) && (!is_null($campo))){
                    return true;
                } else {
                    return false;
                }
        }
    }

?>