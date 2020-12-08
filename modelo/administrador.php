<?php
	 class Administrador
	 {
	 	 private $nombreAdmin;		
		 private $telefono;			
		 private $idAdministrador;	
		 private $conexion;			

		public function __construct($nombreAdmin="", $telefono="", $idAdministrador=-1)
		{
			$this->nombreAdmin = $nombreAdmin;
			$this->telefono = $telefono;
			$this->idAdministrador = $idAdministrador;
			$this->conexion = new conexionBD();
		}

		public function addPersona($nombrePersona, $telefono, $pass)
		{
			$this->conexion->registrarPersona($nombrePersona, $telefono, $pass);
		}

		public function eliminarPersona($idPersona)
		{
			$this->conexion->eliminarPersona($idPersona);
		}

		public function modificarPersona($idPersona, $nombrePersona, $telefono, $pass)
		{
			$this->conexion->modificarPersona($idPersona, $nombrePersona, $telefono, $pass);
		}

		public function addFacilitador($nombreFacilitador, $telefono, $pass)
		{
			$this->conexion->registrarFacilitador($nombreFacilitador, $telefono, $pass);
		}

		public function eliminarFacilitador($idFacilitador)
		{
			$this->conexion->eliminarFacilitador($idFacilitador);
		}

		public function modificarFacilitador($idFacilitador, $nombreFacilitador, $telefono, $pass)
		{
			$this->conexion->modificarFacilitador($idFacilitador, $nombreFacilitador, $telefono, $pass);
		}

		public function addAdministrador($nombreAdministrador, $telefono, $pass)
		{
			$this->conexion->registrarAdministrador($nombreAdministrador, $telefono, $pass);
		}

		public function eliminarAdministrador($idAdministrador)
		{
			$this->conexion->eliminarAdministrador($idAdministrador);
		}

		public function modificarAdministrador($idAdministrador, $nombreAdministrador, $telefono, $pass)
		{
			$this->conexion->modificarAdministrador($idAdministrador, $nombreAdministrador, $telefono, $pass);
		}

		public function getNombre()
		{
			return $this->nombreAdmin;
		}

		public function setNombre($nombre)
		{
			$this->nombreAdmin = $nombre;
		}

		public function getTelefono()
		{
			return $this->telefono;
		}

		public function setTelefono($telefono)
		{
			$this->telefono = $telefono;
		}

		public function getIdAdministrador()
		{
			return $this->idAdministrador;
		}
	 }
?>