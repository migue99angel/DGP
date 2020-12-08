<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];

  session_start();
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['admin']))
  {
    $conexion = new ConexionBD();
    //Faltan los real_escape_string
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $_SESSION['admin'] = $conexion->inicioSesionAdministrador($usuario, $contraseña);
  }
 
  if (isset($_SESSION['admin']))
  {
    header("Location: principalAdmin.php");
  }

  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "index.php";

  echo $twig->render('loginAdministrador.html', $variablesParaTwig);

?>
