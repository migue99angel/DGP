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
  $res = $conexion->getAllEjerciciosAsignados();

  $variablesParaTwig['lista'] = array(
    'accionCheckbox' => 'desasignarEjercicio.php',
    'idCheckbox'     => 'listaEjerciciosAsignados',
    'encCheckbox'    => 'multipart/form-data',
    'tituloLista'    => 'Lista de Ejercicios Asignados',
    'elementos'      => $res,
    //'numeroOcultos'  => 0,
    //'inputOcultos'   => array('listaPersonas'),
    'valorSubmitCheckbox' => 'Desasignar ejercicios'
  );
  
  if (isset($_POST['elementos'])) {
    foreach ($_POST['elementos'] as $ejercicio) {
      $ejerciciosDesasignar[] = $ejercicio;
      echo("<script>console.log('PHP: EJERCICIOaefsefsg " . $ejercicio . "');</script>");
    }
    $_SESSION['ejerciciosDesasignar'] = $ejerciciosDesasignar;
  } else {
    unset($_SESSION['ejerciciosDesasignar']);
  }
  
  if (isset($_SESSION['ejerciciosDesasignar'])) {
    foreach ($_SESSION['ejerciciosDesasignar'] as $ejercicio) {
    	echo("<script>console.log('PHP: EJERCICIO " . $ejercicio . "');</script>");
      $datos = explode('&', $ejercicio);
      $resultado = $conexion->desasignarEjercicio($datos[0], $datos[1], $datos[2], $datos[3]);
    }
    unset($_SESSION['ejerciciosDesasignar']);
  } 
  
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

  echo $twig->render('desasignarEjercicio.html', $variablesParaTwig);

 ?>
