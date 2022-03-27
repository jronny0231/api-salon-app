<?php
    namespace App\Bin;

    class Template {
        protected $file;
        protected $data = array();
      
        public function __construct($file, $args = null) {
            $this->file = $file;
            $this->data = $args;
        }

        public function show(){
            echo $this->output();
        }
          
        private function output() {
            $file = PATCH_VIEWS . $this->file;
            if(file_exists($file)) {
                $file = $file;
            } else if(file_exists($file . ".php")) {
                $file = $file . ".php";
            } else if(file_exists($file . ".html")) {
                $file = $file . ".html";
            } else {
                echo "<h2>No existe la vista: $file</h2><br/>";
            }

            $template = file_get_contents($file);
            if(isset($this->data)){
                $this->commandTag($template, "tag");
            }
            return $template;
        }

        private function tagMapper(String $file){
            
        }

        private function tagReplacer($file, array $data){ 
            foreach ($data as $key => $value) {
                echo $key . " -> " . $value . "/n";
                if(is_array($key)) {
                    foreach ($key as $key2 => $value2) {
                        $file = str_replace("[@$key.".".$key2]", $value2, $file);
                    }
                }
                $tagToReplace = "[@$key]";
                $file = str_replace($tagToReplace, $value, $file);
            }
            return $file;
        }

        /**
         * Function que recibe una etiqueta con funcion y reemplaza las variables en archivo.
         * @param file como contenido del archivo de la vista.
         * @param tag como etiqueta tipo [@foreach(array as key => value)]
         * @param data como arreglo de datos a ser iterados.
         * @return bool state. 
         */
        private function commandTag($file, string $tag){
            //$function = str_replace(' ', '-', $tag); // Replaces all spaces with hyphens.
            //$function = preg_replace('/[^A-Za-z0-9\-]/', '', $function); // Removes special chars.
            $function = $this->getSectionData($file, $tag)->function;
            $segment = $this->getSectionData($file, $tag)->htmlSection;
            $functionArgs = $this->getSectionData($file, $tag)->args;

            $response = $file;

            switch($function){
                case 'foreach':
                    $newSegment = $this->doForeach($segment, $functionArgs, $this->data);
                    $response = str_replace($segment, $newSegment, $response);
                    break;
            
                case 'if':
                    return $this->doIf($segment, $functionArgs);
            }
        }
        
        /**
         * Function que devuelve el segmento de string de la vista en el que se encuentra el comando...
         * y debe tener delimitadores con el mismo nombre.
         */
        private function getSectionData($file, String $command){
            $response = '';
            $function = substr($command, 2, strpos($command, "(") + 2);
            $end = str_replace(' ', '', "[@end-" . $function . "]");
            if(!strpos($file, $end)){
                return false;
            }

            $ini = strpos($file, $command); //Encuentra la posicion inicial del comando en el archivo
            $len = strpos($file, $end, $ini) + strlen($end); //Obtiene el largo total del segmento incl las etiquetas.

            $ini = strpos($command,'(') + 1;
            $haystack = substr($command, strpos($command,'('), strpos($command,')]') - $ini);

            $response = (object) [
                "function" => $function,
                "htmlSection" => substr($file, $ini, $len),
                "args" => $haystack
            ];

            return $response;
        }

        private function doForeach(String $dataFor, String $args, Array $data){
            $arrName = substr($args, 0, strpos($args, " as "));
            foreach ($data as $key => $value) {
                $tag = "[@" . $arrName. "->" .$key . "]";
                $dataFor = str_replace($tag, $value , $dataFor);
            }

            $dataFor = str_replace("[@foreach($args)]", '', $dataFor);
            $dataFor = str_replace("[@end-foreach]", '', $dataFor);
            return $dataFor;
        }

        private function doIf(String $dataFor, String $args){
            return;
        }
    }
