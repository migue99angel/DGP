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
         * @method crearEjercicio. Método que añade una ejercicio a la base de datos
         * @author Miguel Ángel Posadas
         * @param nombreEjercicio El nombre del ejercicio (String)
         * @param tipoEjercicio El tipo del ejercicio (String)
         * @param descripcion Texto de descripción del ejercicio
         * @param fechas Array de fechas
         * @param adjuntos Array de ficheros adjuntos
         */
        public function crearEjercicio($nombreEjercicio,$tipoEjercicio,$descripcion,$fechas,$adjuntos)
        {
            $this->conexion->crearEjercicio($this->$idFacilitador,$nombreEjercicio,$tipoEjercicio,$descripcion,$fechas,$adjuntos);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method eliminarEjercicio. Método que elimina un Ejercicio de la base de datos
         * @author Miguel Ángel Posadas
         * @param idEjercicio. El identificador del Ejercicio
         */
        public function eliminarEjercicio($idEjercicio)
        {
            $this->conexion->eliminarEjercicio($idEjercicio);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method modificarEjercicio. Método que modifica un Ejercicio de la base de datos
         * @author Miguel Ángel Posadas
         * @param nombreEjercicio El nombre de la Ejercicio (String)
         * @param tipoEjercicio El tipo del Ejercicio (String)
         * @param descripcion Texto de descripción del Ejercicio
         * @param fechas Array de fechas
         * @param adjuntos Array de ficheros adjuntos
         * @param idEjercicio. El identificador del Ejercicio
         */
        public function modificarEjercicio($nombreEjercicio,$tipoEjercicio,$descripcion,$fechas,$adjuntos,$idEjercicio)
        {
            $this->conexion->modificarEjercicio($this->$idFacilitador,$nombreEjercicio,$tipoEjercicio,$descripcion,$fechas,$adjuntos,$idEjercicio);
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
         * @param idPersona. El identificador de la persona
         */
        public function eliminarPersona($idPersona)
        {
            $this->conexion->eliminarPersona($idPersona);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method crearGrupo. Método que añade un grupo a la base de datos
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
         * @method valorarEjercicio. Método que añade un Ejercicio a la base de datos
         * @author Miguel Ángel Posadas
         * @param idEjercicio identificador del Ejercicio
         * @param idPersona La persona que se va a calificar
         * @param comentarioValoración Comentario de corrección
         * @param valoracion Nota puesta al Ejercicio
         */
        public function valorarEjercicio($idEjercicio,$idPersona,$comentarioValoracion,$valoracion)
        {
            $this->conexion->valorarEjercicio($this->idFacilitador,$idEjercicio,$idPersona,$comentarioValoracion,$valoracion);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method asignarEjercicio. Método que asigna un Ejercicio a una persona
         * @author Miguel Ángel Posadas
         * @param idEjercicio identificador del Ejercicio
         * @param idPersona La persona a la que se va asignar el Ejercicio
         */
        public function asignarEjercicio($idEjercicio,$idPersona)
        {
            $this->conexion->asignarEjercicio($this->idFacilitador,$idEjercicio,$idPersona);
        }

        /**
         * Este método requiere que todas las variables vengan parseadas y comprobadas del controlador
         * @method asignarEjercicioGrupo. Método que asigna un Ejercicio a un grupo
         * @author Miguel Ángel Posadas
         * @param idEjercicio identificador del Ejercicio
         * @param idGrupo La persona a la que se va asignar el Ejercicio
         */
        public function asignarEjercicioGrupo($idEjercicio,$idGrupo)
        {
            $grupo = $this->conexion->obtenerGrupo($idGrupo);
            for($i = 0; $i < sizeof($grupo); $i++)
                $this->conexion->asignarEjercicio($this->idFacilitador,$idEjercicio,$grupo[$i]);
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