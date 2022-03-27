<?php

    namespace App\Modelos\DB;
    use Exception;
    use PDO;

    class Conexion {

        private $host = "localhost";
        private $port = 3360;
        private $user = "root";
        private $password = "";
        private $db;
        private $charset = "utf8";
        public object $conexion;

        public function __construct(string $dbName){
            $this->db = $dbName;

            $conString = "mysql:hos=".$this->host.":".$this->port
                                .";dbname=".$this->db
                                .";charset=".$this->charset;
            
            try {

                $this->conexion = new PDO($conString,$this->user,$this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (Exception $e) {
                echo "ERROR DE CONEXION: ". $e->getMessage();

            }
        } 
    }

?>