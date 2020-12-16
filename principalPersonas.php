<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require "modelo/persona.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['persona']) && isset($_GET['cerrarSesion']))
  {
    session_destroy();
    header("Location: loginPersonas.php");
  }

  $variablesParaTwig['nombre'] = $_SESSION['persona']->getNombre();

  echo $twig->render('principalPersonas.html', $variablesParaTwig);

?>
