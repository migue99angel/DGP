<?php
    /**
     * @class Tutor
     * @author Miguel Ángel Posadas
     */
    class Tutor
    {
        private $nombreTutor; //Nombre del tutor
        private $telefono;    //Número de teléfono del tutor
        private $conexion;    //Conexion a la base de datos
        private $idTutor;     //Identificador del tutor
        
         /**
         * @method Constructor por defecto
         * @author Miguel Ángel Posadas
         */
        public function __construct()
        {
            $this->nombreAdmin = "";
            $this->telefono = 0;
        }

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param nombreAdmin El nombre del tutor 
         * @param telefono El número de teléfono del tutor
         * @param idTutor El identificador del tutor
         */
        public function __construct1($nombreTutor, $telefono, $idTutor)
        {
            $this->$nombreTutor = $nombreTutor;
            $this->$telefono = $telefono;
            $this->conexion = new ConexionBD();
            $this->idTutor = $idTutor;
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
            $this->conexion->crearActividad($this->$idTutor,$nombreActividad,$tipoActividad,$descripcion,$fechas,$adjuntos);
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
            $this->conexion->modificarActividad($this->$idTutor,$nombreActividad,$tipoActividad,$descripcion,$fechas,$adjuntos,$idActividad);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method registrarUsuario. Método que registra un usuario en el sistema
         * @author Miguel Ángel Posadas
         * @param nombreUsuario 
         * @param email
         * @param password
         */
        public function registrarUsuario($nombreUsuario,$email,$password)
        {
            $this->conexion->registrarUSuario($this->$idTutor,$nombreUsuario,$email,$password);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method eliminarUsuario. Método que elimina un usuario de la base de datos
         * @author Miguel Ángel Posadas
         * @param idActividad. El identificador del usuario
         */
        public function eliminarUsuario($idActividad)
        {
            $this->conexion->eliminarUsuario($idActividad);
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
            $this->conexion->crearGrupo($this->$idTutor,$nombreGrupo,$participantes);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method valorarActividad. Método que añade una actividad a la base de datos
         * @author Miguel Ángel Posadas
         * @param idActividad identificador de la actividad
         * @param idUsuario El usuario que se va a calificar
         * @param comentarioValoración Comentario de corrección
         * @param valoracion Nota puesta a la actividad
         */
        public function valorarActividad($idActividad,$idUsuario,$comentarioValoracion,$valoracion)
        {
            $this->conexion->valorarActividad($this->idTutor,$idActividad,$idUsuario,$comentarioValoracion,$valoracion);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method asignarActividad. Método que asigna una actividad a un usuario
         * @author Miguel Ángel Posadas
         * @param idActividad identificador de la actividad
         * @param idUsuario El usuario al que se va asignar la actividad
         */
        public function asignarActividad($idActividad,$idUsuario)
        {
            $this->conexion->asignarActividad($this->idTutor,$idActividad,$idUsuario);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method asignarActividadGrupo. Método que asigna una actividad a un grupo
         * @author Miguel Ángel Posadas
         * @param idActividad identificador de la actividad
         * @param idGrupo El usuario al que se va asignar la actividad
         */
        public function asignarActividadGrupo($idActividad,$idGrupo)
        {
            $grupo = $this->conexion->obtenerGrupo($idGrupo);
            for($i = 0; $i < sizeof($grupo); $i++)
                $this->conexion->asignarActividad($this->idTutor,$idActividad,$grupo[$i]);
        }

        /**
         * Getter del atributo de clase $nombreTutor
         * @method getNombreTutor
         * @author Miguel Ángel Posadas
         * @return nombreTutor
         */
        public function getNombreTutor()
        {
            return $this->$nombreTutor;
        }

        /**
         * Setter del atributo de clase $nombreTutor
         * @method setNombreTutor
         * @author Miguel Ángel Posadas
         * @param nombreTutor
         */
        public function setNombreTutor($nombreTutor)
        {
            $this->$nombreTutor = $nombreTutor;
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
         * Getter del atributo de clase $idTutor
         * @method getIdTutor
         * @author Miguel Ángel Posadas
         * @return idTutor
         */
        public function getIdTutor()
        {
            return $this->$idTutor;
        }

        /**
         * Setter del atributo de clase $idTutor
         * @method setIdTutor
         * @author Miguel Ángel Posadas
         * @param idTutor
         */
        public function setIdTutor($idTutor)
        {
            $this->$idTutor = $idTutor;
        }
    }

?>