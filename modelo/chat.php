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
        private $fechaAsignacion;
        private $idFacilitador;
        private $ruta;

        /**
         * @method Constructor con parámetros
         * @author Miguel Ángel Posadas
         * @param idChat identificador del chat
         * @param idEjercicio Identificador de la Ejercicio
         * @param idPersona Identificador del usuario
         */
        public function __construct($idChat=-1, $idEjercicio=-1, $idPersona=-1, $fechaAsignacion="", $idFacilitador=-1, $ruta="")
        {
            $this->idChat          = $idChat;
            $this->idEjercicio     = $idEjercicio;
            $this->idPersona       = $idPersona;
            $this->fechaAsignacion = $fechaAsignacion;
            $this->idFacilitador   = $idFacilitador;
            $this->ruta            = $ruta;
        }

        /**
         * @method Método getter de idChat
         * @author Darío Megías Guerrero
         * @return idChat
         */
        public function getIdChat()
        {
            return $this->idChat;
        }

        /**
         * @method método setter de idChat
         * @author Darío Megías Guerrero
         * @param idChat
         */
        public function setIdChat($idChat)
        {
            $this->idChat = $idChat;
        }

        /**
         * @method Método getter del ejercicio
         * @author Miguel Ángel Posadas
         * @return idEjercicio
         */
        public function getIdEjercicio()
        {
            return $this->idEjercicio;
        }

        /**
         * @method método setter del idEjercicio
         * @author Miguel Ángel Posadas
         * @param idEjercicio
         */
        public function setIdEjercicio($idEjercicio)
        {
            return $this->idEjercicio = $idEjercicio;
        }

        /**
         * @method Método getter de la persona
         * @author Miguel Ángel Posadas
         * @return idPersona
         */
        public function getIdPersona()
        {
            return $this->idPersona;
        }

        /**
         * @method método setter de la persona
         * @author Miguel Ángel Posadas
         * @param idPersona
         */
        public function setIdPersona($idPersona)
        {
            $this->idPersona = $idPersona;
        }

        /**
         * @method Método getter de la fecha de asignación por parte del facilitador
         * @author Darío Megías Guerrero
         * @return fechaAsignacion
         */
        public function getFechaAsignacion()
        {
            return $this->fechaAsignacion;
        }

        /**
         * @method método setter de la fecha de asignación
         * @author Darío Megías Guerrero
         * @param fechaAsignacion
         */
        public function setFechaAsignacion($fechaAsignacion)
        {
            $this->fechaAsignacion = $fechaAsignacion;
        }

        /**
         * @method Método getter del idFacilitador
         * @author Darío Megías Guerrero
         * @return idFacilitador
         */
        public function getIdFacilitador()
        {
            return $this->idFacilitador;
        }

        /**
         * @method método setter del idFacilitador
         * @author Darío Megías Guerrero
         * @param idFacilitador
         */
        public function setIdFacilitador($idFacilitador)
        {
            $this->idFacilitador = $idFacilitador;
        }

        /**
         * @method Método getter de la ruta que contiene los mensajes del chat
         * @author Darío Megías Guerrero
         * @return ruta
         */
        public function getRuta()
        {
            return $this->ruta;
        }

        /**
         * @method método setter de la ruta del chat
         * @author Darío Megías Guerrero
         * @param ruta
         */
        public function setRuta($ruta)
        {
            $this->ruta = $ruta;
        }

        /**
         * @method Método que devuelve la ruta correcta para abrir archivos
         * @author Darío Megías Guerrero
         * @return ruta Ruta absoluta calculada en función del archivo actual
         */
        private function getRutaCorrecta() {
            return dirname(dirname(__FILE__)).'/'.$this->getRuta();
        }

        /**
         * @method Método que parsea el contenido del archivo en $ruta y le devuelve como array
         * @author Darío Megías Guerrero
         * @return Array asociativo con el contenido del json perteneciente al chat actual
         */
        public function parseChat($tamMax = null) {
            $rutaArchivo = $this->getRutaCorrecta();

            $archivo = fopen($rutaArchivo,'r') or die("No se pudo abrir el archivo");

            if (filesize($rutaArchivo) > 0)
                $contenido = fread($archivo,$tamMax ? $tamMax : filesize($rutaArchivo));

            //var_dump(filesize($rutaArchivo));


            if ($contenido) {
                $resultado = json_decode($contenido);
                //var_dump($resultado);
            }

            fclose($archivo);

            return $resultado;
        }

        /**
         * @method Método que añade un mensaje al archivo de mensajes
         * @author Darío Megías Guerrero
         * @return Array asociativo con el contenido del json perteneciente al chat actual
         */
        public function addMensaje($mensaje) {
            $rutaArchivo = $this->getRutaCorrecta();
            $mensajes = $this->parseChat();
            $mensajes[] = $mensaje;
            $respuesta = null;

            $archivo = fopen($rutaArchivo,'w') or die("No se pudo abrir el archivo");
            fwrite($archivo,"");
            $exito = fwrite($archivo,json_encode($mensajes).PHP_EOL);
            $punteroAlFinal = ftell($archivo);
            fflush($archivo);
            fclose($archivo);


            if ($exito !== null) {
                $respuesta = $this->parseChat($punteroAlFinal);
            }

            return $respuesta;
        }

    }


?>
