<?php
    namespace SRC\Route\SRC;

    use App\Controladores\Control\Respuesta;
    use Exception;
    use ReflectionMethod;
use ReflectionNamedType;

    class URI {

        var $uri;
        var $htmlMethod;
        var $callback;
        var $matches;
        protected $request;
        protected $response;

        public function __construct(String $uri, String $htmlMethod, $callback) {
            $this->uri = $uri;
            $this->htmlMethod = $htmlMethod;
            $this->callback = $callback;
        }

        public function match($uri) {
            $path = preg_replace('#:([\w]+)#', '([^/]+)',$this->uri);
            $regex = "#^$path$#i";
            if(!preg_match($regex, $uri, $matches)) {
                return false;
            }

            if($this->htmlMethod != $_SERVER['REQUEST_METHOD'] && $this->htmlMethod != "ANY") {
                return false;
            }

            array_shift($matches);
            $this->matches = $matches;
            return true;
        }

        /**
         * Metodo para convocar el metodo de la clase solicitada
         */
        public function call() {
            $this->request = $_REQUEST;
            switch(gettype($this->callback)){

                //Evalua si solo es la instancia de una clase.
                case 'string':
                    $callback[0] = $this->callback;
                    $callback[1] = "index";
                    $this->invokeMethod($callback);
                    break;
                //Evalua si se envia tanto la clase como su funcion.
                case 'array':
                    $this->invokeMethod($this->callback);
                    break;
                //Evalua si se envia una funcion de retorno.
                case 'object':
                    $this->execFunction();
                    break;
            }

            $this->printResponse();
            return;
        }

        /**
         * Metodo privado para llamar la clase usando namespace
         * Se crea una instancia de ReflectionMethod para llamar el objecto de la clase...
         * y el metodo de este invoke para llamar el metodo correspondiente pasandole los parametros.
         */
        private function invokeMethod(array $callback){
            try {
                $class = $callback[0];
                $method = $callback[1];

                $this->parseRequest();
                $classInstance = new $class();
                $classInstance->setRequest($this->request);

                //Asigna un reflejo del metodo solicitado a la variable local $response,
                //Invoca el metodo pasando los parametros del metodo passingVars() y...
                //Asigna la respuesta del metodo a la variable local $response
                $instance = new ReflectionMethod($classInstance, $method);
                $request = $this->passingVars($instance);
                $this->response = $instance->invoke(null, $request);
            } catch (Exception $exc) {
                throw new Exception("El metodo $class.$method no existe. Error:" . $exc->getMessage() , -1);
            }
        }

        /**
         * Funcion que pasa el tipo de variable que corresponde al metodo que sera invocado...
         */
        private function passingVars(ReflectionMethod $instance){
            $parametros = $instance->getParameters();
            if(sizeof($parametros) == 0 ){
                return $this->request;
            } else{
                $tipo = $parametros[0]->getType();
                assert($tipo instanceof ReflectionNamedType);

                switch($tipo->getName()){
                    case "Request":
                        return $this->request;
                        break;

                    case "int":
                        return $this->matches[0];
                        break;

                    case "string":
                        return $this->matches[0];
                        break;
                }
            }            
            return;
        }


        private function parseRequest() {
            $this->request = new Request($this->request);
            $this->matches[] = $this->request;  
        }

        private function execFunction() {
            $this->parseRequest();
            $this->response = call_user_func_array($this->callback, $this->matches);
        }

        private function printResponse(){
            if(is_string($this->response)){
                echo $this->response;
            } else if(is_object($this->response) || is_array($this->response)){
                $res = new Respuesta();
                echo $res->json($this->response);
            } 
        }        
        

        /*

        public function call() {
            try {
                $this->request = $_REQUEST;
                switch (gettype($this->class)) {
                    case 'string':
                        $this->functionFromController();
                        return;
                    case 'object':
                        $this->execFunction();
                        return; 
                }
                $this->printResponse();
            } catch (Exception $exc) {
                echo "Error en el metodo call() " . $exc->getMessage();
            }
        }

        private function functionFromController(){
            $parts = $this->getParts();
            $class = $parts["class"];
            $method = $parts["method"];

            
            //Importamos el controlador
            if(!$this->importController($class)){
                return;
            }
            

            //Preparar la ejecucion
            $this->parseRequest();
            $classInstance = new $class();
            $classInstance->setRequest($this->request);

            //Lanzamos el metodo
            try {
                $this->response = new ReflectionMethod($classInstance, $method);
                $this->response->invoke(null,$this->matches);
                //$this->response = call_user_func_array(array($classInstance, $method), $this->matches);
            } catch (Exception $exc){
                throw new Exception("El metodo $class.$method no existe. Error:" . $exc->getMessage() , -1);
            }
        }

        private function getParts(){
            $parts = array();
            if(strpos($this->class, '@')) {
                $methodParts = explode("@", $this->class);
                $parts["class"] = $methodParts[0];
                $parts["method"] = $methodParts[1];
            } else {
                $parts["class"] = $this->class;
                $parts["method"] = ($this->uri == "/") ? "index" : $this->formatCamelCase($this->uri);
            }

            return $parts;
        }

        private function formatCamelCase(String $uri){
            $parts = preg_split("[-|_]", strtolower($uri));
            $finalString = [];
            foreach ($parts as $key => $part) {
                $finalString[$key] = ($key == 0) ? strtolower($part) : ucfirst($part);
            }
            return implode("",$finalString);
        }

        
        private function importController(String $class){
            $file = $class . ".php";
            if(!file_exists($file)) {
                throw new Exception("El controlador ($file) no existe.", -1);
                return false;
            }

            require_once $file;
            return true;
        }
        

        private function execFunction() {
            $this->parseRequest();
            $this->response = call_user_func_array($this->class, $this->matches);
        }

        private function parseRequest() {
            //$reflectionFunct = new ReflectionMethod($this->class);
            $this->request = new Request($this->request);
            $this->matches[] = $this->request;
            
        }

        private function printResponse(){
            if(is_string($this->response)){
                echo $this->response;
            } else if(is_object($this->response) || is_array($this->response)){
                $res = new Respuesta();
                echo $res->json($this->response);
            } 
        }

        */

    }


?>