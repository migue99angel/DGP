<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  $conexion = new ConexionBD();
  session_start();

  $variablesParaTwig = [];



  if (isset($_SESSION['admin']) && isset($_GET['id']))
  {
    if($_GET['tipoUsuario'] == "Persona")
      $conexion->eliminarPersona($_GET['id']);
    else if($_GET['tipoUsuario'] == "Facilitador")
      $conexion->eliminarFacilitador($_GET['id']);
    else if($_GET['tipoUsuario'] == "Administrador")
    $conexion->eliminarAdministrador($_GET['id']);
    
  }
 

  header("Location: administracion.php?tipoUsuario=" . $_GET['tipoUsuario']);

?>