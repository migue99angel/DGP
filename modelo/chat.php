<?php
    /**
     * @class Chat
     * @author Miguel Ángel Posadas
     */
    class Chat
    {
        private $idChat;
        private $tutor;
        private $usuario;

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param idChat identificador del chat
         * @param tutor El tutor 
         * @param usuario El usuario
         */
        public function __construct($idChat, $tutor, $usuario)
        {
            $this->$idChat = $idChat;
            $this->$tutor = $tutor;
            $this->$usuario = $usuario; 
        }

        /**
         * @method Método getter del usuario
         * @author Miguel Ángel Posadas
         * @return usuario
         */
        public function getUsuario()
        {
            return $this->$usuario;
        }

        /**
         * @method Método getter del tutor
         * @author Miguel Ángel Posadas
         * @return tutor
         */
        public function getTutor()
        {
            return $this->$tutor;
        }

        /**
         * @method método setter del usuario
         * @author Miguel Ángel Posadas
         * @param usuario
         */
        public function setUsuario($usuario)
        {
            $this->$usuario = $usuario;
        }

        /**
         * @method método setter del usuario
         * @author Miguel Ángel Posadas
         * @param tutor
         */
        public function setTutor($tutor)
        {
            return $this->$tutor = $tutor;
        }


    }


?>