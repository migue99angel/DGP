<?php
	class Ejercicio
	{
		private $titulo;
		private $categoria;
		private $descripcion;
		private $fechaCreacion;
		private $multimediaAdjunto;
		private $imagenAdjunta;
		private $idEjercicio;



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

		public function getTitulo()
		{
			return $this->titulo;
		}

		public function setTitulo($nombre)
		{
			$this->titulo = $nombre;
		}

		public function getCategoria()
		{
			return $this->categoria;
		}

		public function setCategoria($tipo)
		{
			$this->categoria = $tipo;
		}

		public function getDescripcion()
		{
			return $this->descripcion;
		}

		public function setDescripcion($descripcion)
		{
			$this->descripcion = $descripcion;
		}

		public function getFechaCreacion()
		{
			return $this->fechaCreacion;
		}

		public function setFechaCreacion($fechaCreacion)
		{
			$this->fechaCreacion = $fechaCreacion;
		}

		public function getMultimediaAdjunto()
		{
			return $this->multimediaAdjunto;
		}

		public function setMultimediaAdjunto($adj)
		{
			$this->multimediaAdjunto = $adj;
		}

		public function getImagenAdjunta()
		{
			return $this->imagenAdjunto;
		}

		public function setImagenAdjunta($img)
		{
			$this->imagenAdjunta = $img;
		}

		public function getIdEjercicio()
		{
			return $this->idEjercicio;
		}

		public function setIdEjercicio($id)
		{
			$this->idEjercicio = $id;
		}
	}


?>
