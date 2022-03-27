<?php
    namespace App\Modelos;

    use App\Modelos\ORM\Modelo;

    class Rol_Permiso extends Modelo {

        protected $id;
        protected $id_rol;
        protected $id_permiso;
        protected $ver;
        protected $crear;
        protected $editar;
        protected $eliminar;

        function __construct($propiedades = null) {
            parent::__construct("rol_permiso", Rol_Permiso::class, $propiedades);
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
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
         * Get the value of ver
         */ 
        public function getVer()
        {
                return $this->ver;
        }

        /**
         * Set the value of ver
         *
         * @return  self
         */ 
        public function setVer($ver)
        {
                $this->ver = $ver;

                return $this;
        }

        /**
         * Get the value of crear
         */ 
        public function getCrear()
        {
                return $this->crear;
        }

        /**
         * Set the value of crear
         *
         * @return  self
         */ 
        public function setCrear($crear)
        {
                $this->crear = $crear;

                return $this;
        }

        /**
         * Get the value of editar
         */ 
        public function getEditar()
        {
                return $this->editar;
        }

        /**
         * Set the value of editar
         *
         * @return  self
         */ 
        public function setEditar($editar)
        {
                $this->editar = $editar;

                return $this;
        }

        /**
         * Get the value of eliminar
         */ 
        public function getEliminar()
        {
                return $this->eliminar;
        }

        /**
         * Set the value of eliminar
         *
         * @return  self
         */ 
        public function setEliminar($eliminar)
        {
                $this->eliminar = $eliminar;

                return $this;
        }
    }
?>