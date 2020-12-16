<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  $conexion = new ConexionBD();
  session_start();

  $variablesParaTwig = [];

  if (isset($_GET['id']))
  {
    if($conexion->eliminarGrupo($_GET['id'])){
    }
  }


  header("Location: administracionGrupo.php");

?>
