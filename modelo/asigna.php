<?php
	class Asigna
	{
		private $idEjercicio;
		private $idFacilitador;
		private $idPersona;
		private $fechaAsignacion;
		private $tituloEjercicio;
		private $nombreFacilitador;
		private $nombrePersona;
		
		public function __construct($idEjercicio=-1, $idFacilitador=-1, $idPersona=-1, $fechaAsignacion="", $tituloEjercicio="", $nombreFacilitador="", $nombrePersona="")
		{
			$this->idEjercicio = $idEjercicio;
			$this->idFacilitador = $idFacilitador;
			$this->idPersona = $idPersona;
			$this->fechaAsignacion = $fechaAsignacion;
			$this->tituloEjercicio = $tituloEjercicio;
			$this->nombreFacilitador = $nombreFacilitador;
			$this->nombrePersona = $nombrePersona;
		}
		
		public function getIdEjercicio()
		{
			return $this->idEjercicio;
		}
		
		public function getIdFacilitador()
		{
			return $this->idFacilitador;
		}
		
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		
		public function getFechaAsignacion()
		{
			return $this->fechaAsignacion;
		}
		
		public function getTituloEjercicio()
		{
			return $this->tituloEjercicio;
		}
		
		public function getNombreFacilitador()
		{
			return $this->nombreFacilitador;
		}
		
		public function getNombrePersona()
		{
			return $this->nombrePersona;
		}
	}
?>
