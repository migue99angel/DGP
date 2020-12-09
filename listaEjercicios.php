<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();

  if(isset($_SESSION['facilitador'])) {
    $conexion = new ConexionBD();
    $ejercicios = $conexion->cargarEjerciciosResueltos();
    $esFacilitador = true;
  }

  $variablesParaTwig = ['ejercicios' => $ejercicios, 'esFacilitador' => true];

  echo $twig->render('listaEjercicios.html', $variablesParaTwig);

?>
