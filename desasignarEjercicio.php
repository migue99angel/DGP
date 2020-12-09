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
  
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

  echo $twig->render('desasignarEjercicio.html', $variablesParaTwig);

 ?>
