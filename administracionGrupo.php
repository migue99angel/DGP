<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $variablesParaTwig = [];
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  $conexion = new ConexionBD();

  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "principalFacilitador.php";
  $variablesParaTwig['lista'] = array();


  $variablesParaTwig['lista'] = $conexion->getAllGrupos();

  echo $twig->render('administracionGrupo.html', $variablesParaTwig);

?>
