<?php
	/**
     * @class Asigna
     * @author José María Gómez García
     */
	class Asigna
	{
		private $idEjercicio;		//Identificador del ejercicio
		private $idFacilitador;		//Identificador del facilitador
		private $idPersona;			//Identificador de la persona
		private $fechaAsignacion;	//Fecha en la que se asigna el ejercicio
		private $titulo;			//Titulo del ejercicio
		private $nombreFacilitador;	//Nombre del Facilitador
		private $nombrePersona;		//Nombre de la persona
		private $fechaResolucion;	//Fecha de resolución
		private $valoracionPersona;	//Valoración del ejercicio
		private $archivoAdjuntoSolucion;	//Archivo adjunto a la solución
		
		/**
		 * @method Constructor con parámetros y sin parámetros
		 * @author José María Gómez García
		 * @param idEjercicio
		 * @param idFacilitador
		 * @param idPersona
		 * @param fechaAsignacion
		 * @param titulo
		 * @param nombreFacilitador
		 * @param nombrePersona
		 * @param fechaResolucion
		 * @param valoracionPersona
		 * @param archivoAdjuntoSolucion
		 */
		public function __construct($idEjercicio=-1, $idFacilitador=-1, $idPersona=-1, $fechaAsignacion="", $titulo="", $nombreFacilitador="", $nombrePersona="", $fechaResolucion="", $valoracionPersona="", $archivoAdjuntoSolucion="")
		{
			$this->idEjercicio = $idEjercicio;
			$this->idFacilitador = $idFacilitador;
			$this->idPersona = $idPersona;
			$this->fechaAsignacion = $fechaAsignacion;
			$this->titulo = $titulo;
			$this->nombreFacilitador = $nombreFacilitador;
			$this->nombrePersona = $nombrePersona;
			$this->fechaResolucion = $fechaResolucion;
			$this->valoracionPersona = $valoracionPersona;
			$this->archivoAdjuntoSolucion = $archivoAdjuntoSolucion;
		}
		
		/**
		 * @method getIdEjercicio Devuelve el identificador del ejercicio
		 * @author José María Gómez García
		 * @return idEjercicio
		 */
		public function getIdEjercicio()
		{
			return $this->idEjercicio;
		}
		
		/**
		 * @method setIdEjercicio Asigna el identificador del ejercicio
		 * @author José María Gómez García
		 * @param idEjercicio
		 */
		public function setIdEjercicio($idEjercicio)
		{
			$this->idEjercicio = $idEjercicio;
		}
		
		/**
		 * @method getIdFacilitador Devuelve el identificador del facilitador
		 * @author José María Gómez García
		 * @return idFacilitador
		 */
		public function getIdFacilitador()
		{
			return $this->idFacilitador;
		}
		
		/**
		 * @method setIdFacilitador Asigna el identificador del facilitador
		 * @author José María Gómez García
		 * @param idFacilitador
		 */
		public function setIdFacilitador($idFacilitador)
		{
			$this->idFacilitador = $idFacilitador;
		}
		
		/**
		 * @method getIdPersona Devuelve el identificador de la persona
		 * @author José María Gómez García
		 * @return idPersona
		 */
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		
		/**
		 * @method setIdPersona Asigna el identificador del facilitador
		 * @author José María Gómez García
		 * @param idPersona
		 */
		public function setIdPersona($idPersona)
		{
			$this->idPersona = $idPersona;
		}
		
		/**
		 * @method getFechaAsignacion Devuelve la fecha de asignacion
		 * @author José María Gómez García
		 * @return fechaAsignacion
		 */
		public function getFechaAsignacion()
		{
			return $this->fechaAsignacion;
		}
		
		/**
		 * @method setFechaAsignacion Asigna la fecha de asignacion
		 * @author José María Gómez García
		 * @param fechaAsignacion
		 */
		public function setFechaAsignacion($fechaAsignacion)
		{
			$this->fechaAsignacion = $fechaAsignacion;
		}
		
		/**
		 * @method getTitulo Devuelve el titulo del ejercicio
		 * @author José María Gómez García
		 * @return titulo
		 */
		public function getTitulo()
		{
			return $this->titulo;
		}
		
		/**
		 * @method setTitulo Asigna el título del ejercicio
		 * @author José María Gómez García
		 * @param titulo
		 */
		public function setTitulo($titulo)
		{
			$this->titulo = $titulo;
		}
		
		/**
		 * @method getTitulo Devuelve el nombre del facilitador
		 * @author José María Gómez García
		 * @return nombreFacilitador
		 */
		public function getNombreFacilitador()
		{
			return $this->nombreFacilitador;
		}
		
		/**
		 * @method setNombreFacilitador
		 * @author José María Gómez García
		 * @param nombreFacilitador
		 */
		public function setNombreFacilitador($nombreFacilitador)
		{
			$this->nombreFacilitador = $nombreFacilitador;
		}
		
		/**
		 * @method getNombrePersona Devuelve el nombre de la persona
		 * @author José María Gómez García
		 * @return nombrePersona
		 */
		public function getNombrePersona()
		{
			return $this->nombrePersona;
		}
		
		/**
		 * @method setNombrePersona Asigna el nombre de una persona
		 * @author José María Gómez García
		 * @param nombrePersona
		 */
		public function setNombrePersona($nombrePersona)
		{
			$this->nombrePersona = $nombrePersona;
		}
		
		/**
		 * @method getFechaResolucion Devuelve la fecha de resolución
		 * @author José María Gómez García
		 * @return fechaResolucion
		 */
		public function getFechaResolucion()
		{
			return $this->fechaResolucion;
		}
		
		/**
		 * @method setFechaResolucion Asigna la fecha de resolución
		 * @author José María Gómez García
		 * @param fechaResolucion
		 */
		public function setFechaResolucion($fechaResolucion)
		{
			$this->fechaResolucion = $fechaResolucion;
		}
		
		/**
		 * @method getValoracionPersona Devuelve la valoración
		 * @author José María Gómez García
		 * @return valoracionPersona
		 */
		public function getValoracionPersona()
		{
			return $this->valoracionPersona;
		}
		
		/**
		 * @method setValoracionPersona Asigna la valoración
		 * @author José María Gómez García
		 * @param valoracionPersona
		 */
		public function setValoracionPersona($valoracionPersona)
		{
			$this->valoracionPersona = $valoracionPersona;
		}
		
		/**
		 * @method getArchivoAdjuntoSolucion Devuelve el archivo adjunto
		 * @author José María Gómez García
		 * @return archivoAdjuntoSolucion
		 */
		public function getArchivoAdjuntoSolucion()
		{
			return $this->archivoAdjuntoSolucion;
		}
		
		/**
		 * @method setArchivoAdjuntoSolucion Asigna el archivo adjunto
		 * @author José María Gómez García
		 * @param archivoAdjuntoSolucion
		 */
		public function setArchivoAdjuntoSolucion($archivoAdjuntoSolucion)
		{
			$this->archivoAdjuntoSolucion = $archivoAdjuntoSolucion;
		}
	}
?>
