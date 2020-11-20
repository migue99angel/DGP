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
			$this->$idAdministrador = "";
			$this->$conexion = new ConexionBD();
		}

		public function __construct1($nombreAdmin, $telefono, $idAdministrador)
		{
			$this->$nombreAdmin = $nombreAdmin;
			$this->$telefono = $telefono;
			$this->$idAdministrador = $idAdministrador;
			$this->$conexion = new conexionBD();
		}

		public function addTutor($usuario)
		{
			// Implementar
		}

		public function eliminarTutor($u)
		{
			// Implementar
		}

		public function modificarTutor($u)
		{
			// Implementar
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
	 }
?>