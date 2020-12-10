<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  $variablesParaTwig['tipoUsuario'] = $_GET['tipoUsuario'];

  echo $twig->render('administracion.html', $variablesParaTwig);

?>
