<?php
	class Actividad
	{
		private $nombreActividad;
		private $tipoActividad;
		private $descripcion;
		private $fecha;
		private $adjunto;
		private $idActividad;



		public function __construct()
		{
			$this->$nombreActividad = "";
			$this->$tipoActividad = "";
			$this->$descripcion = "";
			$this->$fecha = "";
			$this->$adjunto = "";
			$this->$idActividad = -1;
		}

		public function __construct1($nombreActividad, $tipoActividad, $descripcion, $fecha, $adjunto, $idActividad)
		{
			$this->$nombreActividad = $nombreActividad;
			$this->$tipoActividad = $tipoActividad;
			$this->$descripcion = $descripcion;
			$this->$fecha = $fecha;
			$this->$adjunto = $adjunto;
			$this->$idActividad = $idActividad;

		}

		public function getNombre()
		{
			return $this->$nombreActividad;
		}

		public function setNombre($nombre)
		{
			$this->$nombreActividad = $nombre;
		}

		public function getTipo()
		{
			return $this->$tipoActividad;
		}

		public function setTipo($tipo)
		{
			$this->$tipoActividad = $tipo;
		}

		public function getDescripcion()
		{
			return $this->$descripcion;
		}

		public function setDescripcion($descripcion)
		{
			$this->$descripcion = $descripcion;
		}

		public function getFecha()
		{
			return $this->$fecha;
		}

		public function setFecha($fecha)
		{
			$this->$fecha = $fecha;
		}

		public function setAdjunto($adj)
		{
			$this->$adjunto = $adj;
		}

		public function getAdjunto($pos)
		{
			return $this->$adjunto[$pos];
		}

		public function getAlladjunto()
		{
			return $this->$adjunto;
		}
	}


?>