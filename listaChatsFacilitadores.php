<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $conexion = new ConexionBD();
  $variablesParaTwig = array();

  session_start();

  if (isset($_SESSION['facilitador'])) {
      $ejercicios = $conexion->cargarEjerciciosAsignadosPorFacilitador($_SESSION['facilitador']->getIdFacilitador());
      var_dump($ejercicios);
  }

  echo $twig->render("listaChatsFacilitadores.html",$variablesParaTwig);

  ?>
