<?php
    /**
     * @class Usuario
     * @author Miguel Ángel Posadas
     */
    class Usuario
    {
        private $nombreUsuario;     //String con el nombre de usuario
        private $email;             // String con el email del usuario
        private $chat;              //Array con los chats asociados a este usuario    
        private $grupos;            //Array con los grupos asociados a este usuario
        private $actividades;       //Array con las actividades asociadas a ester usuario

        /**
         * @method Constructor por defecto
         * @author Miguel Ángel Posadas
         */
        public function __construct()
        {
            $this->$nombreUsuario = "";
            $this->$email = "";
            $this->$chat = array();
            $this->$grupos = array();
            $this->$actividades = array();
        }

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param nombreUsuario El nombre del usuario 
         * @param email El email del nuevo usuario
         */
        public function __construct1($nombreUsuario, $email)
        {
            $this->$nombreUsuario = $nombreUsuario;
            $this->$email = $email;
            $this->$chat = array();
            $this->$grupos = array();
            $this->$actividades = array();
        }

        /**
         * @method Constructor con todos los parámetros
         * @author Miguel Ángel Posadas
         * @param nombreUsuario El nombre del usuario 
         * @param email El email del nuevo usuario
         * @param chat Array con los chats asociados a este usuario
         * @param grupos Array con los grupos asociados a este usuario
         * @param actividades Array con las actividades asociadas a este usuario
         */
        public function __construct2($nombreUsuario, $email, $chat, $grupos,$actividades )
        {
            $this->$nombreUsuario = $nombreUsuario;
            $this->$email = $email;
            $this->$chat = $chat;
            $this->$grupos = $grupos;
            $this->$actividades = $actividades;
        }
        
        /**
         * Getter del atributo de clase $nombreUsuario
         * @method getNombreUsuario
         * @author Miguel Ángel Posadas
         * @return nombreUsuario
         */
        public function getNombreUsuario()
        {
            return $this->$nombreUsuario;
        }

        /**
         * Setter del atributo de clase $nombreUsuario
         * @method setNombreUsuario
         * @author Miguel Ángel Posadas
         * @param nombreUsuario
         */
        public function setNombreUsuario($nombreUsuario)
        {
            $this->$nombreUsuario = $nombreUsuario;
        }

        /**
         * Getter del atributo de clase $email
         * @method getMail
         * @author Miguel Ángel Posadas
         * @return email
         */
        public function getMail()
        {
            return $this->$email;
        }

        /**
         * Setter del atributo de clase $email
         * @method setMail
         * @author Miguel Ángel Posadas
         * @param email
         */
        public function setMail($email)
        {
            $this->$email = $email;
        }


        /**
         * Getter del atributo de clase $chat
         * @method getChat
         * @author Miguel Ángel Posadas
         * @return chat
         */
        public function getChat()
        {
            return $this->$chat;
        }

        /**
         * Setter del atributo de clase $chat
         * @method setChat
         * @author Miguel Ángel Posadas
         * @param chat
         */
        public function setChat($chat)
        {
            $this->$chat = $chat;
        }

        /**
         * Getter del atributo de clase $grupo
         * @method getGrupo
         * @author Miguel Ángel Posadas
         * @return grupo
         */
        public function getGrupo()
        {
            return $this->$grupo;
        }

        /**
         * Setter del atributo de clase $grupo
         * @method setGrupo
         * @author Miguel Ángel Posadas
         * @param grupo
         */
        public function setGrupo($grupo)
        {
            $this->$grupo = $grupo;
        }

        /**
         * Getter del atributo de clase $actividades
         * @method getActividades
         * @author Miguel Ángel Posadas
         * @return actividades
         */
        public function getActividades()
        {
            return $this->$actividades;
        }

        /**
         * Setter del atributo de clase $grupo
         * @method setGrupo
         * @author Miguel Ángel Posadas
         * @param grupo
         */
        public function setActividades($actividades)
        {
            $this->$actividades = $actividades;
        }

    }

?>