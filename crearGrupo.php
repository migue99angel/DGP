<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";
  require_once "./modelo/facilitador.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  $variablesParaTwig['botonAtras'] = True;

  session_start();
  $conexion = new ConexionBD();
  $ejerciciosAsignar = array();

  if(!isset($_POST['nombre'])){
    $variablesParaTwig['paginaAnterior'] = 'administracionGrupo.php';
    $variablesParaTwig['seleccionMiembros'] = False;

  }
  else if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $variablesParaTwig['exitoGrupos'] = $conexion->crearGrupo($_SESSION['facilitador']->getidFacilitador(),$nombre);
    $idGrupo = $conexion->cargarGrupoNombre($nombre);
    $_SESSION['id'] = $idGrupo;
    $variablesParaTwig['lista'] = array(
      'accionCheckbox' => 'administracionGrupo.php',
      'idCheckbox'     => 'listaPersonas',
      'encCheckbox'    => 'multipart/form-data',
      'elementos'      => $conexion->getAllPersonas(),
      'valorSubmitCheckbox' => 'Insertar en el Grupo'
    );
    $variablesParaTwig['paginaAnterior'] = 'crearGrupo.php';
    $variablesParaTwig['tipoLista'] = 'personas';
    $variablesParaTwig['seleccionMiembros'] = True;
  }


  $variablesParaTwig['test'] = $id;
  echo $twig->render('crearGrupo.html', $variablesParaTwig);

?>
