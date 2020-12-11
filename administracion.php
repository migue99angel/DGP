<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  $variablesParaTwig['tipoUsuario'] = $_GET['tipoUsuario'];
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "principalAdmin.php";

  echo $twig->render('administracion.html', $variablesParaTwig);

?>
