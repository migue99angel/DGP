<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin']) && isset($_POST['cerrarSesion']))
  {
    session_destroy();
    header("Location: loginAdministrador.php");
  }

  echo $twig->render('principalAdmin.html', $variablesParaTwig);

?>
