<?php
	 class Administrador
	 {
	 	 private $nombreAdmin;		
		 private $telefono;			
		 private $idAdministrador;	
		 private $conexion;			

		 
		public function __construct()
		{
			$this->$nombreAdmin = "";
			$this->$telefono = "";
			$this->$idAdministrador = -1;
			$this->$conexion = new ConexionBD();
		}

		public function __construct1($nombreAdmin, $telefono, $idAdministrador)
		{
			$this->$nombreAdmin = $nombreAdmin;
			$this->$telefono = $telefono;
			$this->$idAdministrador = $idAdministrador;
			$this->$conexion = new conexionBD();
		}

		public function addTutor($nombreTutor, $telefono, $pass)
		{
			$this->$conexion->registrarTutor($nombreTutor, $telefono, $pass);
		}

		public function eliminarTutor($idTutor)
		{
			$this->$conexion->eliminarTutor($idTutor);
		}

		public function modificarTutor($idTutor, $nombreTutor, $telefono, $pass)
		{
			$this->$conexion->modificarTutor($idTutor, $nombreTutor, $telefono, $pass);
		}

		public function getNombre()
		{
			return $this->$nombreAdmin;
		}

		public function setNombre($nombre)
		{
			$this->$nombreAdmin = $nombre;
		}

		public function getTelefono()
		{
			return $this->$telefono;
		}

		public function setTelefono($telefono)
		{
			$this->$telefono = $telefono;
		}

		public function getIdAdministrador()
		{
			return $this->$idAdministrador;
		}
	 }
?>