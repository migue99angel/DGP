<?php
    /**
     * @class Facilitador
     * @author Miguel Ángel Posadas
     */
    class Facilitador
    {
        private $nombreFacilitador; //Nombre del facilitador
        private $telefono;    //Número de teléfono del facilitador
        private $conexion;    //Conexion a la base de datos
        private $idFacilitador;     //Identificador del facilitador
        
         /**
         * @method Constructor por defecto
         * @author Miguel Ángel Posadas
         */
        public function __construct()
        {
            $this->nombreFacilitador = "";
            $this->telefono = 0;
        }

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param nombreFacilitador El nombre del facilitador 
         * @param telefono El número de teléfono del facilitador
         * @param idFacilitador El identificador del facilitador
         */
        public function __construct1($nombreFacilitador, $telefono, $idFacilitador)
        {
            $this->$nombreFacilitador = $nombreFacilitador;
            $this->$telefono = $telefono;
            $this->conexion = new ConexionBD();
            $this->idFacilitador = $idFacilitador;
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method crearActividad. Método que añade una actividad a la base de datos
         * @author Miguel Ángel Posadas
         * @param nombreActividad El nombre de la actividad (String)
         * @param tipoActividad El tipo de la actividad (String)
         * @param descripcion Texto de descripción de la actividad
         * @param fechas Array de fechas
         * @param adjuntos Array de ficheros adjuntos
         */
        public function crearActividad($nombreActividad,$tipoActividad,$descripcion,$fechas,$adjuntos)
        {
            $this->conexion->crearActividad($this->$idFacilitador,$nombreActividad,$tipoActividad,$descripcion,$fechas,$adjuntos);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method eliminarActividad. Método que elimina una actividad de la base de datos
         * @author Miguel Ángel Posadas
         * @param idActividad. El identificador de la actividad
         */
        public function eliminarActividad($idActividad)
        {
            $this->conexion->eliminarActividad($idActividad);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method modificarActividad. Método que modifica una actividad de la base de datos
         * @author Miguel Ángel Posadas
         * @param nombreActividad El nombre de la actividad (String)
         * @param tipoActividad El tipo de la actividad (String)
         * @param descripcion Texto de descripción de la actividad
         * @param fechas Array de fechas
         * @param adjuntos Array de ficheros adjuntos
         * @param idActividad. El identificador de la actividad
         */
        public function modificarActividad($nombreActividad,$tipoActividad,$descripcion,$fechas,$adjuntos,$idActividad)
        {
            $this->conexion->modificarActividad($this->$idFacilitador,$nombreActividad,$tipoActividad,$descripcion,$fechas,$adjuntos,$idActividad);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method registrarPersona. Método que registra una persona en el sistema
         * @author Miguel Ángel Posadas
         * @param nombrePersona 
         * @param email
         * @param password
         */
        public function registrarPersona($nombrePersona,$email,$password)
        {
            $this->conexion->registrarPersona($this->$idFacilitador,$nombrePersona,$email,$password);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method eliminarPersona. Método que elimina una persona de la base de datos
         * @author Miguel Ángel Posadas
         * @param idActividad. El identificador de la persona
         */
        public function eliminarPersona($idActividad)
        {
            $this->conexion->eliminarPersona($idActividad);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method crearGrupo. Método que añade una actividad a la base de datos
         * @author Miguel Ángel Posadas
         * @param nombreGrupo El nombre del grupo (String)
         * @param participantes Array de participantes
         */
        public function crearGrupo($nombreGrupo,$participantes)
        {
            $this->conexion->crearGrupo($this->$idFacilitador,$nombreGrupo,$participantes);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method valorarActividad. Método que añade una actividad a la base de datos
         * @author Miguel Ángel Posadas
         * @param idActividad identificador de la actividad
         * @param idPersona La persona que se va a calificar
         * @param comentarioValoración Comentario de corrección
         * @param valoracion Nota puesta a la actividad
         */
        public function valorarActividad($idActividad,$idPersona,$comentarioValoracion,$valoracion)
        {
            $this->conexion->valorarActividad($this->idFacilitador,$idActividad,$idPersona,$comentarioValoracion,$valoracion);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method asignarActividad. Método que asigna una actividad a una persona
         * @author Miguel Ángel Posadas
         * @param idActividad identificador de la actividad
         * @param idPersona La persona a la que se va asignar la actividad
         */
        public function asignarActividad($idActividad,$idPersona)
        {
            $this->conexion->asignarActividad($this->idFacilitador,$idActividad,$idPersona);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method asignarActividadGrupo. Método que asigna una actividad a un grupo
         * @author Miguel Ángel Posadas
         * @param idActividad identificador de la actividad
         * @param idGrupo La persona a la que se va asignar la actividad
         */
        public function asignarActividadGrupo($idActividad,$idGrupo)
        {
            $grupo = $this->conexion->obtenerGrupo($idGrupo);
            for($i = 0; $i < sizeof($grupo); $i++)
                $this->conexion->asignarActividad($this->idFacilitador,$idActividad,$grupo[$i]);
        }

        /**
         * Getter del atributo de clase $nombreFacilitador
         * @method getnombreFacilitador
         * @author Miguel Ángel Posadas
         * @return nombreFacilitador
         */
        public function getnombreFacilitador()
        {
            return $this->$nombreFacilitador;
        }

        /**
         * Setter del atributo de clase $nombreFacilitador
         * @method setnombreFacilitador
         * @author Miguel Ángel Posadas
         * @param nombreFacilitador
         */
        public function setnombreFacilitador($nombreFacilitador)
        {
            $this->$nombreFacilitador = $nombreFacilitador;
        }

        /**
         * Getter del atributo de clase $telefono
         * @method getTelefono
         * @author Miguel Ángel Posadas
         * @return telefono
         */
        public function getTelefono()
        {
            return $this->$telefono;
        }

        /**
         * Setter del atributo de clase $telefono
         * @method setTelefono
         * @author Miguel Ángel Posadas
         * @param telefono
         */
        public function setTelefono($telefono)
        {
            $this->$telefono = $telefono;
        }

        /**
         * Getter del atributo de clase $idFacilitador
         * @method getidFacilitador
         * @author Miguel Ángel Posadas
         * @return idFacilitador
         */
        public function getidFacilitador()
        {
            return $this->$idFacilitador;
        }

        /**
         * Setter del atributo de clase $idFacilitador
         * @method setidFacilitador
         * @author Miguel Ángel Posadas
         * @param idFacilitador
         */
        public function setidFacilitador($idFacilitador)
        {
            $this->$idFacilitador = $idFacilitador;
        }
    }

?>