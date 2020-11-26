<?php
	class Ejercicio
	{
		private $nombreEjercicio;
		private $tipoEjercicio;
		private $descripcion;
		private $fecha;
		private $adjunto;
		private $idEjercicio;



		public function __construct()
		{
			$this->$nombreEjercicio = "";
			$this->$tipoEjercicio = "";
			$this->$descripcion = "";
			$this->$fecha = "";
			$this->$adjunto = "";
			$this->$idEjercicio = -1;
		}

		public function __construct1($nombreEjercicio, $tipoEjercicio, $descripcion, $fecha, $adjunto, $idEjercicio)
		{
			$this->$nombreEjercicio = $nombreEjercicio;
			$this->$tipoEjercicio = $tipoEjercicio;
			$this->$descripcion = $descripcion;
			$this->$fecha = $fecha;
			$this->$adjunto = $adjunto;
			$this->$idEjercicio = $idEjercicio;

		}

		public function getNombre()
		{
			return $this->$nombreEjercicio;
		}

		public function setNombre($nombre)
		{
			$this->$nombreEjercicio = $nombre;
		}

		public function getTipo()
		{
			return $this->$tipoEjercicio;
		}

		public function setTipo($tipo)
		{
			$this->$tipoEjercicio = $tipo;
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