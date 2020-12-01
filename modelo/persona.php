<?php
    /**
     * @class Persona
     * @author Miguel Ángel Posadas
     */
    class Persona
    {
        private $idPersona;         //Identificador de la persona
        private $nombrePersona;     //String con el nombre de la persona
        private $chat;              //Array con los chats asociados a esta persona    
        private $grupos;            //Array con los grupos asociados a esta persona
        private $ejercicios;       //Array con las ejercicios asociadas a esta persona

        /**
         * @method Constructor por defecto
         * @author Miguel Ángel Posadas
         */
        public function __construct()
        {
            $this->$nombrePersona = "";
            $this->$chat = array();
            $this->$grupos = array();
            $this->$ejercicios = array();
        }

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param nombrePersona El nombre de la persona 
         */
        public function __construct1($idPersona,$nombrePersona)
        {
            $this->$idPersona = $idPersona;
            $this->$nombrePersona = $nombrePersona;
            $this->$chat = array();
            $this->$grupos = array();
            $this->$ejercicios = array();
        }

        /**
         * @method Constructor con todos los parámetros
         * @author Miguel Ángel Posadas
         * @param nombrePersona El nombre de esta persona 
         * @param chat Array con los chats asociados a esta persona
         * @param grupos Array con los grupos asociados a esta persona
         * @param ejercicios Array con las ejercicios asociadas a esta persona
         */
        public function __construct2($idPersona,$nombrePersona,$chat,$grupos,$ejercicios )
        {
            $this->$idPersona = $idPersona;
            $this->$nombrePersona = $nombrePersona;
            $this->$chat = $chat;
            $this->$grupos = $grupos;
            $this->$ejercicios = $ejercicios;
        }
        
        /**
         * Getter del atributo de clase $nombrePersona
         * @method getNombrePersona
         * @author Miguel Ángel Posadas
         * @return nombrePersona
         */
        public function getNombrePersona()
        {
            return $this->$nombrePersona;
        }

        /**
         * Setter del atributo de clase $nombrePersona
         * @method setNombrePersona
         * @author Miguel Ángel Posadas
         * @param nombrePersona
         */
        public function setNombrePersona($nombrePersona)
        {
            $this->$nombrePersona = $nombrePersona;
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
         * Getter del atributo de clase $ejercicios
         * @method getejercicios
         * @author Miguel Ángel Posadas
         * @return ejercicios
         */
        public function getEjercicios()
        {
            return $this->$ejercicios;
        }

        /**
         * Setter del atributo de clase $grupo
         * @method setGrupo
         * @author Miguel Ángel Posadas
         * @param grupo
         */
        public function setEjercicios($ejercicios)
        {
            $this->$ejercicios = $ejercicios;
        }

        /**
         * Getter del atributo de clase $idPersona
         * @method getIdPersona
         * @author Miguel Ángel Posadas
         * @return idPersona
         */
        public function getIdPersona()
		{
			return $this->$idPersona;
		}

    }

?>