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

		/**
		 * @method Constructor con parámetros
		 * @author Miguel Muñoz Molina
		 * @param $nombreGrupo El nombre del grupo
		 * @param $participantes Array con los participantes del grupo
		 * @param $idGrupo identificador del grupo
		 */
		public function __construct($nombreGrupo="", $participantes="", $idGrupo="")
		{
			$this->nombreGrupo = $nombreGrupo;
			$this->idGrupo = $idGrupo;
			$this->paticipantes = $participantes;
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