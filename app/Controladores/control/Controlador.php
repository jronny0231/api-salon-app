<?php 
    namespace App\Controladores\Control;

    use App\Bin\View;
    use App\Bin\Template;

    class Controlador {

        protected $request;
        private $view;
        private $template;

        function __construct()
        {
            
        }

        public function view($file, $variables = null) {
            if(empty($this->view)) {
                $this->view = new View($file, $variables);
            }
            return $this->view->render();
        }

        public function template($file, $args = null) {
            if(empty($this->template)) {
                $this->template = new Template($file, $args);
            }
            return $this->template->show();
        }

        public function getRequest() {
            return $this->request;
        }

        public function setRequest($request) {
            $this->request = $request;
        }
    }

?>