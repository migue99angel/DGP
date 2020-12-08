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


  if(!isset($_POST['nombre'])){
    $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';
    $variablesParaTwig['seleccionMiembros'] = False;

  }
  else{
    //$_SESSION['facilitador'].crearGrupo($_POST['nombre']);
    $variablesParaTwig['paginaAnterior'] = 'crearGrupo.php';
    $variablesParaTwig['accionCheckbox'] = 'crearGrupo.php';
    $variablesParaTwig['idCheckbox'] = 'listaPersonas';
    $variablesParaTwig['encCheckbox'] = 'multipart/form-data';
    $variablesParaTwig['tituloLista'] = 'Lista de Personas';
    $variablesParaTwig['tipoLista'] = 'personas';
    //$variablesParaTwig['elementos'] = $conexion->getAllPersonas();
    $variablesParaTwig['valorSubmitCheckbox'] = 'Insertar en el Grupo';
    $variablesParaTwig['seleccionMiembros'] = True;
  }

  echo $twig->render('crearGrupo.html', $variablesParaTwig);

?>
