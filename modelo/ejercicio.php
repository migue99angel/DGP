<?php
	/**
     * @class Ejercicio
     * @author Miguel Muñoz Molina
     */
	class Ejercicio
	{
		private $titulo;			//Título del ejercicio
		private $categoria;			//Categoría del ejercicio
		private $descripcion;		//Descripción del ejercicio
		private $fechaCreacion;		//Fecha de creación del ejercicio
		private $multimediaAdjunto;	//Url con el archivo multimedia adjunto
		private $imagenAdjunta;		//Url con la imagen adjunta
		private $idEjercicio;		//Identificador del ejercicio

		/**
		 * @method Constructor con parámetros y sin parámetros
		 * @author Miguel Muñoz Molina
		 * @param titulo
		 * @param categoria
		 * @param descripcion
		 * @param fechaCreacion
		 * @param mAdjunto
		 * @param iAdjunta
		 * @param idEjercicio
		 */
		public function __construct($titulo="", $categoria="", $descripcion="", $fechaCreacion="", $mAdjunto="", $iAdjunta="", $idEjercicio=-1)
		{
			$this->titulo = $titulo;
			$this->categoria = $categoria;
			$this->descripcion = $descripcion;
			$this->fechaCreacion = $fechaCreacion;
			$this->multimediaAdjunto = $mAdjunto;
			$this->imagenAdjunta = $mAdjunto;
			$this->idEjercicio = $idEjercicio;
		}

		/**
		 * @method getTitulo Devuelve el titulo del ejercicio
		 * @author Miguel Muñoz Molina
		 * @return titulo
		 */
		public function getTitulo()
		{
			return $this->titulo;
		}

		/**
		 * @method setTitulo Asigna el título del ejercicio
		 * @author Miguel Muñoz Molina
		 * @param nombre
		 */
		public function setTitulo($nombre)
		{
			$this->titulo = $nombre;
		}

		/**
		 * @method getCategoria Devuelve la categoría del ejercicio
		 * @author Miguel Muñoz Molina
		 * @return categoria
		 */
		public function getCategoria()
		{
			return $this->categoria;
		}

		/**
		 * @method setCategoria Asigna la categoria del ejercicio
		 * @author Miguel Muñoz Molina
		 * @param tipo
		 */
		public function setCategoria($tipo)
		{
			$this->categoria = $tipo;
		}

		/**
		 * @method getDescripcion Devuelve la descripcion del ejercicio
		 * @author Miguel Muñoz Molina
		 * @return descripcion
		 */
		public function getDescripcion()
		{
			return $this->descripcion;
		}

		/**
		 * @method setDescripcion Asigna la descripcion a un ejercicio
		 * @author Miguel Muñoz Molina
		 * @param descripcion
		 */
		public function setDescripcion($descripcion)
		{
			$this->descripcion = $descripcion;
		}

		/**
		 * @method getFechaCreacion Devuelve la fecha de creación
		 * @author Miguel Muñoz Molina
		 * @return fechaCreacion
		 */
		public function getFechaCreacion()
		{
			return $this->fechaCreacion;
		}

		/**
		 * @method setFechaCreacion Asigna la fecha de creacion
		 * @author Miguel Muñoz Molina
		 * @param fechaCreacion
		 */
		public function setFechaCreacion($fechaCreacion)
		{
			$this->fechaCreacion = $fechaCreacion;
		}

		/**
		 * @method getMultimediaAdjunto Devuelve la url del archivo multimedia
		 * @author Miguel Muñoz Molina
		 * @return multimediaAdjunto
		 */
		public function getMultimediaAdjunto()
		{
			return $this->multimediaAdjunto;
		}

		/**
		 * @method setMultimediaAdjunto Asigna la url del archivo multimedia
		 * @author Miguel Muñoz Molina
		 * @param adj
		 */
		public function setMultimediaAdjunto($adj)
		{
			$this->multimediaAdjunto = $adj;
		}

		/**
		 * @method getImagenAdjunta Devuelve la url de la imagen adjunta
		 * @author Miguel Muñoz Molina
		 * @return imagenAdjunto
		 */
		public function getImagenAdjunta()
		{
			return $this->imagenAdjunto;
		}

		/**
		 * @method setImagenAdjunta Asigna la url de la imagen adjunta
		 * @author Miguel Muñoz Molina
		 * @param img
		 */
		public function setImagenAdjunta($img)
		{
			$this->imagenAdjunta = $img;
		}

		/**
		 * @method getIdEjercicio Devuelve el identificador del ejercicio
		 * @author Miguel Muñoz Molina
		 * @return idEjercicio
		 */
		public function getIdEjercicio()
		{
			return $this->idEjercicio;
		}

		/**
		 * @method setIdEjercicio Asigna el identificador del ejercicio
		 * @author Miguel Muñoz Molina
		 * @param id
		 */
		public function setIdEjercicio($id)
		{
			$this->idEjercicio = $id;
		}
	
	}


?>
