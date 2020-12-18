<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";
  session_start();

  $variablesParaTwig = [];
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  $conexion = new ConexionBD();

  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "principalFacilitador.php";
  $variablesParaTwig['lista'] = array();

  if (isset($_POST['elementos'])) {
    foreach ($_POST['elementos'] as $personas) {
      $variablesParaTwig['exitoPersonas'] = $conexion->asignarGrupo($_SESSION['id'],$personas);
    }
  }


  $variablesParaTwig['lista'] = $conexion->getAllGrupos();

  echo $twig->render('administracionGrupo.html', $variablesParaTwig);

?>
