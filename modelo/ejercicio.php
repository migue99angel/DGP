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



		public function __construct()
		{
			$this->titulo = "";
			$this->categoria = "";
			$this->descripcion = "";
			$this->fechaCreacion = "";
			$this->multimediaAdjunto = "";
			$this->imagenAdjunta = "";
			$this->idEjercicio = -1;
		}

		public static function crearConParametros($titulo, $categoria, $descripcion, $fechaCreacion, $mAdjunto, $iAdjunta, $idEjercicio)
		{
			$instancia = new Ejercicio();

			$instancia->setTitulo($titulo);
			$instancia->setCategoria($categoria);
			$instancia->setDescripcion($descripcion);
			$instancia->setFechaCreacion($fechaCreacion);
			$instancia->setMultimediaAdjunto($mAdjunto);
			$instancia->setImagenAdjunta($iAdjunta);
			$instancia->setIdEjercicio($idEjercicio);

			return $instancia;
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
