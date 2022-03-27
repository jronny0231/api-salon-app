<?php
    namespace App\Modelos;

    use App\Modelos\ORM\Modelo;

    class Rol extends Modelo {

        protected $id_rol;
        protected $descripcion;

        function __construct($propiedades = null) {
            parent::__construct("rol", Rol::class, $propiedades);
        }


        /**
         * Get the value of id_rol
         */ 
        public function getId_rol()
        {
                return $this->id_rol;
        }

        /**
         * Set the value of id_rol
         *
         * @return  self
         */ 
        public function setId_rol($id_rol)
        {
                $this->id_rol = $id_rol;

                return $this;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }
    }
?>