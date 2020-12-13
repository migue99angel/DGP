<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";
  
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $conexion = new ConexionBD();
  $variablesParaTwig = [];
  session_start();


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin']) && isset($_POST['cerrarSesion']))
  {
    session_destroy();
    header("Location: loginAdministrador.php");
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin']) && isset($_POST['registrar']))
  {
    if($_POST['registrar'] === "Facilitador")
    {
      $conexion->registrarFacilitador($_POST['usuario'],$_POST['telefono'],$_POST['contraseña']);
    }
    if($_POST['registrar'] === "Administrador")
    {
      $conexion->registrarAdministrador($_POST['usuario'],$_POST['telefono'],$_POST['contraseña']);
    }
    if($_POST['registrar'] === "Persona")
    {
      $conexion->registrarPersonas($_POST['usuario'],$_POST['telefono'],$_POST['contraseña']);
    }

  }
  echo $twig->render('principalAdmin.html', $variablesParaTwig);

?>
