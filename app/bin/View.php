<?php
    namespace App\Bin;

use Exception;

    class View {

        protected $data;
        protected $file;
        protected $output;

        function __construct(String $file, array $data = null){
            $this->file = PATCH_VIEWS . $file;
            $this->data = $data;
        }

        public function render(){
           
            try {
                ob_start();
                $this->includeFile($this->file);
                $this->output = ob_get_contents();
                ob_end_clean();
                
                // Devuelve el archivo de la vista.
                echo $this->output;

            } catch (Exception $ecx) {
                echo new Exception("Error en la vista {$this->file}: " . $ecx->getMessage());
            }
        }

        public function __set($key, $value){
            $this->data[$key] = $value;
        }

        public function __get($key){
            if(isset($this->data[$key])){
                return $this->data[$key];
            }

            return null;
        }

        /*
        private function loadVars(String $file, Array $vars){
            $fileOutput = file_get_contents($file);
          
            foreach ($vars as $key => $value) {
                $tagToReplace = "[@$key]";
                $fileOutput = str_replace($tagToReplace, $value, $fileOutput);
            }

            return $fileOutput;
        }
        */

        private function includeFile($file) {
            //Creamos las data en el contexto actual
            if(isset($this->data) && is_array($this->data)){
                
                foreach ($this->data as $key => $value) {
                    global ${$key};
                    ${$key} = $value;
                }
            }

            if(file_exists($file)) {
                include($file);
            } else if(file_exists($file . ".php")) {
                include($file . ".php");
            } else if(file_exists($file . ".html")) {
                include($file . ".html");
            } else {
                echo "<h2>No existe la vista: $file</h2><br/>";
            }
        }
    }


?>