<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  $conexion = new ConexionBD();

  $variablesParaTwig = [];
  $variablesParaTwig['tipoUsuario'] = $_GET['tipoUsuario'];
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "principalAdmin.php";
  $variablesParaTwig['lista'] = array();

  if($_GET['tipoUsuario'] === "Persona")
  {
    $variablesParaTwig['lista'] = $conexion->getAllPersonas();
  }
  if($_GET['tipoUsuario'] === "Facilitador")
  { 
    $variablesParaTwig['lista'] = $conexion->getAllFacilitadores();
  }
  if($_GET['tipoUsuario'] === "Administrador")
  {
    $variablesParaTwig['lista'] = $conexion->getAllAdministradores();
  }

  if(sizeof($variablesParaTwig['lista']) === 0)
  {
    array_push($variablesParaTwig['lista'],"No hay ningún elemento disponible");
  }


  echo $twig->render('administracion.html', $variablesParaTwig);

?>
