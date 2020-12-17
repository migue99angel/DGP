<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";
  require_once "./modelo/asigna.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();
  $variablesParaTwig = [];
  
  if (!isset($_SESSION['facilitador'])) {
    exit();
  }
  
  $conexion = new ConexionBD();
  
  if (isset($_POST['elementos'])) {
    foreach ($_POST['elementos'] as $ejercicio) {
      $ejerciciosDesasignar[] = $ejercicio;
    }
    $_SESSION['ejerciciosDesasignar'] = $ejerciciosDesasignar;
  } else {
    unset($_SESSION['ejerciciosDesasignar']);
  }
  
  if (isset($_SESSION['ejerciciosDesasignar'])) {
    foreach ($_SESSION['ejerciciosDesasignar'] as $ejercicio) {
      $datos = explode('&', $ejercicio);
      $resultado = $conexion->desasignarEjercicio($datos[0], $datos[1], $datos[2], $datos[3]);
    }
    unset($_SESSION['ejerciciosDesasignar']);
  }
  
  $res = $conexion->getAllEjerciciosAsignadosByFacilitador($_SESSION['facilitador']->getidFacilitador());

  $variablesParaTwig['lista'] = array(
    'accionCheckbox' => 'desasignarEjercicio.php',
    'idCheckbox'     => 'listaEjerciciosAsignados',
    'encCheckbox'    => 'multipart/form-data',
    'elementos'      => $res,
    'valorSubmitCheckbox' => 'DESASIGNAR EJERCICIOS'
  );
  
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

  echo $twig->render('desasignarEjercicio.html', $variablesParaTwig);

 ?>
