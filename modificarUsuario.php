<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  $variablesParaTwig['tipoUsuario'] = $_GET['tipoUsuario'];
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "administracion.php?tipoUsuario=" . $_GET['tipoUsuario'];;

  echo $twig->render('modificarUsuario.html', $variablesParaTwig);

?>