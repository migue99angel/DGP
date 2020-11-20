<?php
	class Actividad
	{
		private $nombreActividad;
		private $tipoActividad;
		private $descripcion;
		private $fecha;
		private $adjuntos;
		private $idActividad;
		private $conexion;
		private $usuarios;

		public function __construct()
		{
			$this->$nombreActividad = "";
			$this->$tipoActividad = "";
			$this->$descripcion = "";
			$this->$fecha = "";
			$this->$adjuntos = array();
			$this->$idActividad = 0;
			$this->$conexion = new conexionBD();
			$this->$usuarios = "";
		}

		public function __construct1($nombreActividad, $tipoActividad, $descripcion, $fecha, $adjuntos, $idActividad, $usuarios)
		{
			$this->$nombreActividad = $nombreActividad;
			$this->$tipoActividad = $tipoActividad;
			$this->$descripcion = $descripcion;
			$this->$fecha = $fecha;
			$this->$adjuntos = $adjuntos;
			$this->$idActividad = $idActividad;
			$this->$conexion = new conexionBD();
			$this->$usuarios = $usuarios;
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

		public function addAdjunto($adj)
		{
			array_push($this->$adjuntos, $adj);
		}

		public function getAdjunto($pos)
		{
			return $this->$adjuntos[$pos];
		}

		public function getAllAdjuntos()
		{
			return $this->$adjuntos;
		}
	}


?>