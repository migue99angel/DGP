<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];

  // Llamar a función de eliminar usuario

  // Volver a la administración
  header("Location: administracion.php?tipoUsuario=" . $_GET['tipoUsuario']);

?>