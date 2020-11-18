<?php
    /**
     * @class Chat
     * @author Miguel Ángel Posadas
     */
    class Chat
    {
        private $idChat;
        private $idActividad;
        private $idUsuario;

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param idChat identificador del chat
         * @param idActividad Identificador de la actividad 
         * @param idUsuario Identificador del usuario
         */
        public function __construct($idChat, $idActividad, $idUsuario)
        {
            $this->$idChat = $idChat;
            $this->$idActividad = $idActividad;
            $this->$idUsuario = $idUsuario; 
        }

        /**
         * @method Método getter del usuario
         * @author Miguel Ángel Posadas
         * @return idUsuario
         */
        public function getUsuario()
        {
            return $this->$idUsuario;
        }

        /**
         * @method Método getter del tutor
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
         * @param idUsuario
         */
        public function setUsuario($idUsuario)
        {
            $this->$idUsuario = $idUsuario;
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