<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();

  if(isset($SESSION['facilitador'])) {
    $conexion = new ConexionBD();
    $ejercicios = $conexion->cargarEjerciciosResueltos();
  }

  $variablesParaTwig = [$ejercicios];

  echo $twig->render('listaEjercicios.html', $variablesParaTwig);

?>
