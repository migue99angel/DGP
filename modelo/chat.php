<?php
    /**
     * @class Chat
     * @author Miguel Ángel Posadas
     */
    class Chat
    {
        private $idChat;
        private $idEjercicio;
        private $idPersona;

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param idChat identificador del chat
         * @param idEjercicio Identificador de la Ejercicio 
         * @param idPersona Identificador del usuario
         */
        public function __construct($idChat, $idEjercicio, $idPersona)
        {
            $this->idChat = $idChat;
            $this->idEjercicio = $idEjercicio;
            $this->idPersona = $idPersona; 
        }

        /**
         * @method Método getter del usuario
         * @author Miguel Ángel Posadas
         * @return idPersona
         */
        public function getUsuario()
        {
            return $this->idPersona;
        }

        /**
         * @method Método getter del facilitador
         * @author Miguel Ángel Posadas
         * @return idEjercicio
         */
        public function getEjercicio()
        {
            return $this->idEjercicio;
        }

        /**
         * @method método setter del usuario
         * @author Miguel Ángel Posadas
         * @param idPersona
         */
        public function setUsuario($idPersona)
        {
            $this->idPersona = $idPersona;
        }

        /**
         * @method método setter del idEjercicio
         * @author Miguel Ángel Posadas
         * @param idEjercicio
         */
        public function setEjercicio($idEjercicio)
        {
            return $this->idEjercicio = $idEjercicio;
        }


    }


?>