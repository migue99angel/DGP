<?php
	/**
	 * @class Grupos
	 * @author Miguel Muñoz Molina
	 */
	class Grupos
	{
		private $nombreGrupo;		//String con el nombre del grupo
		private $idGrupo;			//Int con el identificador del grupo
		private $participantes;		//Array con los participantes del grupo
		private $fechaCreacion;     //Fecha de creación

		/**
		 * @method Constructor con parámetros
		 * @author Miguel Muñoz Molina
		 * @param $nombreGrupo El nombre del grupo
		 * @param $participantes Array con los participantes del grupo
		 * @param $idGrupo identificador del grupo
		 */
		public function __construct($nombreGrupo="", $participantes=array(), $idGrupo="", $fechaCreacion="")
		{
			$this->nombreGrupo = $nombreGrupo;
			$this->idGrupo = $idGrupo;
			$this->participantes = $participantes;
			$this->fechaCreacion = $fechaCreacion;
		}

		/**
		 * Getter del atributo de clase $idGrupo
		 * @method getIdGrupo
		 * @author Miguel Muñoz Molina
		 * @return $idGrupo
		 */
		public function getIdGrupo()
		{
			return $this->idGrupo;
		}

		/**
		 * Getter del atributo de clase $nombreGrupo
		 * @method getNombreGrupo
		 * @author Miguel Muñoz Molina
		 * @return $nombreGrupo
		 */
		public function getNombreGrupo()
		{
			return $this->nombreGrupo;
		}

		/**
		 * Getter del atributo de clase $participantes
		 * @method getAllParticipantes
		 * @author Miguel Muñoz Molina
		 * @return $participantes
		 */
		public function getAllParticipantes()
		{
			return $this->participantes;
		}

		/**
		 * Setter del atributo de clase $nombreGrupo
		 * @method setNombreGrupo
		 * @author Miguel Muñoz Molina
		 * @param $nombre El nombre del grupo
		 */
		public function setNombreGrupo($nombre)
		{
			$this->nombreGrupo = $nombre;
		}

		/**
		 * Setter del atributo de clase $fechaCreacion
		 * @method setFechaCreacion
		 * @author Miguel Muñoz Molina y Darío Megías Guerrero
		 * @param $fecha La fecha de creación del grupo
		 */
		public function setFechaCreacion($fecha)
		{
			$this->setFechaCreacion = $fechaCreacion;
		}

		/**
		 * Getter del atributo de clase $fechaCreacion
		 * @method getFechaCreacion
		 * @author Miguel Muñoz Molina y Darío Megías Guerrero
		 */
		public function getFechaCreacion()
		{
			return $this->fechaCreacion;
		}

		/**
		 * Método para borrar un elemento del array $participantes
		 * @method eliminarParticipante
		 * @author Miguel Muñoz Molina
		 * @param $p Una persona
		 */
		public function eliminarParticipante($p)
		{
			if (($key = array_search($p, $this->participantes)) !== false)
			{
				unset($p[$key]);
			}
		}

		/**
		 * Método para añadir un elemento al array $participantes
		 * @method addParticipante
		 * @author Miguel Muñoz Molina
		 * @param $p Una persona
		 */
		public function addParticipante($p)
		{
			array_push($this->participantes, $p);
		}
	}

?>
