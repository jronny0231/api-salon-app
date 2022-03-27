<?php

    namespace App\Modelos\ORM;

    use Exception;
    use App\Modelos\ORM\DB;

    class Modelo extends DB{
        
        private $className;
        private $excluir = ["className","tabla","conexion","selects","wheres","joins","sql","excluir"];

        function __construct($tabla, $className, $propiedades = null){
            parent::__construct($tabla);
            
            $this->className = $className;

            if (empty($propiedades)) {
                return;
            }

            foreach ($propiedades as $llave => $valor) {
                $this->{$llave} = $valor;
            }
        }

        protected function getAttributes(){
            $variables = get_class_vars($this->className);
            $atributos = [];
            $max = count($variables);
            foreach ($variables as $llave => $valor) {
                if (!in_array($llave, $this->excluir)) {
                    $atributos[] = $llave;
                }
            }

            return $atributos;
        }

        protected function parsear(Array $obj = null) {
            try {
                $atributos = $this->getAttributes();
                $objFinal = [];

                //Obtener el objeto desde el modelo.
                if($obj == null) {
                    foreach($atributos as $indice => $llave){
                        if(isset($this->{$llave})){
                            $objFinal[$llave] = $this->{$llave};
                        }
                    }
                    return $objFinal;
                }

                //Corregir el objeto que recibimos con los atributos del modelo.
                foreach ($atributos as $indice => $llave) {
                    if(isset($obj[$llave])) {
                        $objFinal[$llave] = $obj[$llave];
                    }
                }
                return $objFinal;
            } catch (Exception $ex) {
                throw new Exception("Error en " . $this->className . ". parsear() => " . $ex->getMessage());
            }
        }

        public function fill(Object $obj){
            try {
                $atributos = $this->getAttributes();
                foreach($atributos as $indice => $llave){
                    if(isset($obj[$llave])){
                        $this->{$llave} = $obj[$llave];
                    }
                }
            } catch (Exception $ex) {
                throw new Exception("Error en " . $this->className . ". fill() => " . $ex->getMessage());
            }
        }

        //Metodos CRUD disponibles en la clase DB

        /**
         * Metodo para insertar nuevos registros de usuario
         * @param Data as Object, @return ID.
         */
        public function insert(Array $obj = null){
            $obj = $this->parsear($obj);
            return parent::insert($obj);
        }

        public function update(Array $obj) {
            $obj = $this->parsear($obj);
            return parent::update($obj);
        }

        /**
         * Metodo para obtener el valor de un atributo.
         * @param nomAtributo as String, @return result as String.
         */
        public function __get($nomAtributo){
            return $this->{$nomAtributo};
        }

        /**
         * Metodo para setear el valor de un atributo.
         * @param nomAtributo as String, @param valor as String.
         */
        public function __set($nomAtributo, $valor){
            $this->{$nomAtributo} = $valor;
        }
    }
?>