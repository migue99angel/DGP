<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];

  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['facilitador']))
  {
    $conexion = new ConexionBD();
    //Faltan los real_escape_string
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $_SESSION['facilitador'] = $conexion->inicioSesionFacilitador($usuario, $contraseña);
  }

  if (isset($_SESSION['facilitador']))
  {
    header("Location: principalFacilitador.php");
  }


  echo $twig->render('loginFacilitador.html', $variablesParaTwig);

?>
