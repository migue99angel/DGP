<?php
	/**
     * @class Administrador
     * @author Miguel Muñoz Molina
     */
	 class Administrador
	 {
	 	 private $nombreAdmin;		//Nombre del administrador	
		 private $telefono;			//Teléfono del administrador
		 private $idAdministrador;	//Identificador del administrador
		 private $conexion;			//Conexión a la base de datos

		/**
		 * @method Constructor con parámetros y sin parámetros
		 * @author Miguel Muñoz Molina
		 * @param nombreAdmin
		 * @param telefono
		 * @param idAdministrador
		 */
		public function __construct($nombreAdmin="", $telefono="", $idAdministrador=-1)
		{
			$this->nombreAdmin = $nombreAdmin;
			$this->telefono = $telefono;
			$this->idAdministrador = $idAdministrador;
			$this->conexion = new conexionBD();
		}

		/**
		 * @method addPersona Añade una persona al sistema
		 * @author Miguel Muñoz Molina
		 * @param nombrePersona
		 * @param telefono
		 * @param pass
		 */
		public function addPersona($nombrePersona, $telefono, $pass)
		{
			$this->conexion->registrarPersona($nombrePersona, $telefono, $pass);
		}

		/**
		 * @method eliminarPersona Elimina a una persona del sistema
		 * @author Miguel Muñoz Molina
		 * @param idPersona
		 */
		public function eliminarPersona($idPersona)
		{
			$this->conexion->eliminarPersona($idPersona);
		}

		/**
		 * @method modificarPersona Modifica los datos de una persona
		 * @author Miguel Muñoz Molina
		 * @param idPersona
		 * @param nombrePersona
		 * @param telefono
		 * @param pass
		 */
		public function modificarPersona($idPersona, $nombrePersona, $telefono, $pass)
		{
			$this->conexion->modificarPersona($idPersona, $nombrePersona, $telefono, $pass);
		}

		/**
		 * @method addFacilitador Añade un facilitador al sistema
		 * @author Miguel Muñoz Molina
		 * @param nombreFacilitador
		 * @param telefono
		 * @param pass
		 */
		public function addFacilitador($nombreFacilitador, $telefono, $pass)
		{
			$this->conexion->registrarFacilitador($nombreFacilitador, $telefono, $pass);
		}

		/**
		 * @method eliminarFacilitador
		 * @author Miguel Muñoz Molina
		 * @param idFacilitador
		 */
		public function eliminarFacilitador($idFacilitador)
		{
			$this->conexion->eliminarFacilitador($idFacilitador);
		}

		/**
		 * @method modificarFacilitador Modifica la información de un facilitador
		 * @author Miguel Muñoz Molina
		 * @param idFacilitador
		 * @param nombreFacilitador
		 * @param telefono
		 * @param pass
		 */
		public function modificarFacilitador($idFacilitador, $nombreFacilitador, $telefono, $pass)
		{
			$this->conexion->modificarFacilitador($idFacilitador, $nombreFacilitador, $telefono, $pass);
		}

		/**
		 * @method addAdministrador Añade un administrador al sistema
		 * @author Miguel Muñoz Molina
		 * @param nombreAdministrador
		 * @param telefono
		 * @param pass
		 */
		public function addAdministrador($nombreAdministrador, $telefono, $pass)
		{
			$this->conexion->registrarAdministrador($nombreAdministrador, $telefono, $pass);
		}

		/**
		 * @method eliminarAdministrador Elimina un administrador del sistema
		 * @author Miguel Muñoz Molina
		 * @param idAdministrador
		 */
		public function eliminarAdministrador($idAdministrador)
		{
			$this->conexion->eliminarAdministrador($idAdministrador);
		}

		/**
		 * @method modificarAdministrador Modifica los datos de un administrador
		 * @author Miguel Muñoz Molina
		 * @param idAdministrador
		 * @param nombreAdministrador
		 * @param telefono
		 * @param pass
		 */
		public function modificarAdministrador($idAdministrador, $nombreAdministrador, $telefono, $pass)
		{
			$this->conexion->modificarAdministrador($idAdministrador, $nombreAdministrador, $telefono, $pass);
		}

		/**
		 * @method getNombre Devuelve el nombre del administrador
		 * @return nombreAdmin
		 */
		public function getNombre()
		{
			return $this->nombreAdmin;
		}

		/**
		 * @method setNombre Establece el nombre del administrador
		 * @param nombre
		 */
		public function setNombre($nombre)
		{
			$this->nombreAdmin = $nombre;
		}

		/**
		 * @method getTelefono Devuelve el telefono del administrador
		 * @return telefono
		 */
		public function getTelefono()
		{
			return $this->telefono;
		}
		
		/**
		 * @method setTelefono Establece el atributo telefono
		 * @param telefono
		 */
		public function setTelefono($telefono)
		{
			$this->telefono = $telefono;
		}

		/**
		 * @method getIdAdministrador Devuelve el identificador del administrador
		 * @return idAdministrador
		 */
		public function getIdAdministrador()
		{
			return $this->idAdministrador;
		}
	 }
?>