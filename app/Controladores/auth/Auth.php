<?php
    namespace App\Controladores\Auth;

    class Auth {
        private $sesion;
        private $data;

        public function __construct() {
            
        }

        public static function isLogged(){
            return true;
        }
    }