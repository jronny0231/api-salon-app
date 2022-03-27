<?php
    namespace App\Modelos;

    use App\Modelos\ORM\Modelo;

    class Permiso extends Modelo {

        protected $id_permiso;
        protected $descripcion;
        protected $componente;

        function __construct($propiedades = null) {
            parent::__construct("permiso", Permiso::class, $propiedades);
        }

        

        /**
         * Get the value of id_permiso
         */ 
        public function getId_permiso()
        {
                return $this->id_permiso;
        }

        /**
         * Set the value of id_permiso
         *
         * @return  self
         */ 
        public function setId_permiso($id_permiso)
        {
                $this->id_permiso = $id_permiso;

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

        /**
         * Get the value of componente
         */ 
        public function getComponente()
        {
                return $this->componente;
        }

        /**
         * Set the value of componente
         *
         * @return  self
         */ 
        public function setComponente($componente)
        {
                $this->componente = $componente;

                return $this;
        }
    }

?>