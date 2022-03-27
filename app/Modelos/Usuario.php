<?php

    namespace App\Modelos;

    use App\Modelos\ORM\Modelo;

    class Usuario extends Modelo{

        protected $id_usuario;
        protected $nombre;
        protected $correo;
        protected $username;
        protected $clave_encrypt;
        protected $id_rol;
        protected $fecha_creado;

        public function __construct($propiedades = null){
            parent::__construct("usuario", Usuario::class, $propiedades);
        }

        /**
         * Metodo getter para retornar el id del usuario seleccionado
         * @return id_user as integer.
         */
        function getId_Usuario(){
            return $this->id_usuario;
        }

        /**
         * Metodo setter para setear el id del usuario seleccionado
         * @param id_user as integer.
         */
        function setId_Usuario($id_usuario){
            $this->id_usuario = $id_usuario;
        }

        /**
         * Metodo getter para retornar el nombre del usuario seleccionado
         * @return name as string.
         */
        function getNombre(){
            return $this->nombre;
        }

        /**
         * Metodo setter para setear el nombre del usuario seleccionado
         * @param name as string.
         */
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        /**
         * Metodo getter para retornar el correo del usuario seleccionado
         * @return email as string.
         */
        function getCorreo(){
            return $this->correo;
        }

        /**
         * Metodo setter para setear el correo del usuario seleccionado
         * @param email as string.
         */
        function setCorreo($correo){
            $this->correo = $correo;
        }

        /**
         * Metodo getter para retornar el username del usuario seleccionado
         * @return username as string.
         */
        function getUsername(){
            return $this->username;
        }

        /**
         * Metodo setter para setear el username del usuario seleccionado
         * @param username as string.
         */
        function setUsername($username){
            $this->username = $username;
        }

        /**
         * Metodo getter para retornar la clave del usuario seleccionado
         * @return password as string.
         */
        function getClave_Encrypt(){
            return $this->clave_encrypt;
        }

        /**
         * Metodo setter para setear y encriptar la clave del usuario seleccionado
         * @param password as string.
         */
        function setClave_Encrypt($clave_encrypt){
            $this->clave_encrypt = md5($clave_encrypt);
        }

        /**
         * Metodo getter para retornar el id del rol del usuario seleccionado
         * @return id_role as string.
         */
        function geId_Rol(){
            return $this->id_rol;
        }

        /**
         * Metodo setter para setear el id del rol del usuario seleccionado
         * @param id_role as string.
         */
        function seId_Rol($id_rol){
            $this->id_rol = md5($id_rol);
        }

        /**
         * Metodo getter para retornar la fecha de creacion del usuario seleccionado
         * @return create_at as datetime.
         */
        function getFecha_Creado(){
            return $this->fecha_creado;
        }

        /**
         * Metodo setter para setear y encriptar la fecha de creacion del usuario seleccionado
         * @param create_at as datetime.
         */
        function setFecha_Creado($fecha_creado){
            $this->fecha_creado = md5($fecha_creado);
        }
        
    }
?>