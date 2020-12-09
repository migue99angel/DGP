<?php
	class Asigna
	{
		private $idEjercicio;
		private $idFacilitador;
		private $idPersona;
		private $fechaAsignacion;
		private $titulo;
		private $nombreFacilitador;
		private $nombrePersona;
		
		public function __construct($idEjercicio=-1, $idFacilitador=-1, $idPersona=-1, $fechaAsignacion="", $titulo="", $nombreFacilitador="", $nombrePersona="")
		{
			$this->idEjercicio = $idEjercicio;
			$this->idFacilitador = $idFacilitador;
			$this->idPersona = $idPersona;
			$this->fechaAsignacion = $fechaAsignacion;
			$this->titulo = $titulo;
			$this->nombreFacilitador = $nombreFacilitador;
			$this->nombrePersona = $nombrePersona;
		}
		
		public function getIdEjercicio()
		{
			return $this->idEjercicio;
		}
		
		public function setIdEjercicio($idEjercicio)
		{
			$this->idEjercicio = $idEjercicio;
		}
			
		public function getIdFacilitador()
		{
			return $this->idFacilitador;
		}
		
		public function setIdFacilitador($idFacilitador)
		{
			$this->idFacilitador = $idFacilitador;
		}
		
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		
		public function setIdPersona($idPersona)
		{
			$this->idPersona = $idPersona;
		}
		
		public function getFechaAsignacion()
		{
			return $this->fechaAsignacion;
		}
		
		public function setFechaAsignacion($fechaAsignacion)
		{
			$this->fechaAsignacion = $fechaAsignacion;
		}
		
		public function getTitulo()
		{
			return $this->titulo;
		}
		
		public function setTitulo($titulo)
		{
			$this->titulo = $titulo;
		}
		
		public function getNombreFacilitador()
		{
			return $this->nombreFacilitador;
		}
		
		public function setNombreFacilitador($nombreFacilitador)
		{
			$this->nombreFacilitador = $nombreFacilitador;
		}
		
		public function getNombrePersona()
		{
			return $this->nombrePersona;
		}
		
		public function setNombrePersona($nombrePersona)
		{
			$this->nombrePersona = $nombrePersona;
		}
	}
?>
