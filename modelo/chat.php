<?php
    /**
     * @class Chat
     * @author Miguel Ángel Posadas
     */
    class Chat
    {
        private $idChat;
        private $idActividad;
        private $idPersona;

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param idChat identificador del chat
         * @param idActividad Identificador de la actividad 
         * @param idPersona Identificador del usuario
         */
        public function __construct($idChat, $idActividad, $idPersona)
        {
            $this->$idChat = $idChat;
            $this->$idActividad = $idActividad;
            $this->$idPersona = $idPersona; 
        }

        /**
         * @method Método getter del usuario
         * @author Miguel Ángel Posadas
         * @return idPersona
         */
        public function getUsuario()
        {
            return $this->$idPersona;
        }

        /**
         * @method Método getter del facilitador
         * @author Miguel Ángel Posadas
         * @return idActividad
         */
        public function getActividad()
        {
            return $this->$idActividad;
        }

        /**
         * @method método setter del usuario
         * @author Miguel Ángel Posadas
         * @param idPersona
         */
        public function setUsuario($idPersona)
        {
            $this->$idPersona = $idPersona;
        }

        /**
         * @method método setter del idActividad
         * @author Miguel Ángel Posadas
         * @param idActividad
         */
        public function setActividad($idActividad)
        {
            return $this->$idActividad = $idActividad;
        }


    }


?>