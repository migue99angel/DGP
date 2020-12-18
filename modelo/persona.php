<?php
    /**
     * @class Persona
     * @author Miguel Ángel Posadas
     */
    class Persona
    {
        private $idPersona;         //Identificador de la persona
        private $tlfPersona;        //Teléfono de una persona
        private $nombre;            //String con el nombre de la persona
        private $contraseña;        //String con la contraseña hasheada
        private $grupos;            //Array con los grupos asociados a esta persona
        private $ejercicios;        //Array con las ejercicios asociadas a esta persona

        /**
         * @method Constructor con todos los parámetros
         * @author Miguel Ángel Posadas
         * @param nombre El nombre de esta persona
         * @param grupos Array con los grupos asociados a esta persona
         * @param ejercicios Array con las ejercicios asociadas a esta persona
         */
        public function __construct($idPersona=NULL,$nombre="",$contraseña="",$tlfPersona)
        {
            $this->idPersona = $idPersona;
            $this->tlfPersona = $tlfPersona;
            $this->nombre = $nombre;
            $this->contraseña = $contraseña;
            $this->grupos = array();
            $this->ejercicios = array();
        }

        /**
         * Getter del atributo de clase $nombre
         * @method getNombre
         * @author Miguel Ángel Posadas
         * @return nombre
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * Setter del atributo de clase $nombre
         * @method setNombrePersona
         * @author Miguel Ángel Posadas
         * @param nombre
         */
        public function setNombrePersona($nombre)
        {
            $this->nombre = $nombre;
        }

        /**
         * Getter del atributo de clase $contraseña
         * @method getContraseña
         * @author Jose Luis Gallego Peña
         * @return contraseña
         */
        public function getContraseña()
        {
            return $this->contraseña;
        }

        /**
         * Setter del atributo de clase $contraseñ
         * @method setContraseña
         * @author Jose Luis Gallego Peña
         * @param contra
         */
        public function setContraseña($contra)
        {
            $this->contraseña = $contraseña;
        }

        /**
         * Getter del atributo de clase $grupo
         * @method getGrupo
         * @author Miguel Ángel Posadas
         * @return grupo
         */
        public function getGrupo()
        {
            return $this->grupo;
        }

        /**
         * Setter del atributo de clase $grupo
         * @method setGrupo
         * @author Miguel Ángel Posadas
         * @param grupo
         */
        public function setGrupo($grupo)
        {
            $this->grupo = $grupo;
        }

        /**
         * Getter del atributo de clase $ejercicios
         * @method getejercicios
         * @author Miguel Ángel Posadas
         * @return ejercicios
         */
        public function getEjercicios()
        {
            return $this->ejercicios;
        }

        /**
         * Setter del atributo de clase $grupo
         * @method setGrupo
         * @author Miguel Ángel Posadas
         * @param grupo
         */
        public function setEjercicios($ejercicios)
        {
            $this->ejercicios = $ejercicios;
        }

        /**
         * Getter del atributo de clase $idPersona
         * @method getIdPersona
         * @author Miguel Ángel Posadas
         * @return idPersona
         */
        public function getIdPersona()
		{
			return $this->idPersona;
		}

        /**
         * Setter del atributo de clase $tlfPersona
         * @method setTlfPersona
         * @author Miguel Ángel Posadas y Darío Megías Guerrero
         * @param tlf
         */
        public function setTlfPersona($tlf)
        {
            $this->tlfPersona = $tlf;
        }

        /**
         * Getter del atributo de clase $tlfPersona
         * @method getTlfPersona
         * @author Miguel Ángel Posadas y Darío Megías Guerrero
         * @return tlfPersona
         */
        public function getTlfPersona()
		{
			return $this->tlfPersona;
		}

    }

?>
