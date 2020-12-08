<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  $variablesParaTwig['correcto'] = true;

  session_start();

  // Contraseña de la persona
  $contraseña = "";

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pictograma']) && !isset($_SESSION['persona']))
  {
    $contraseña = $_POST['pictograma'];
    
    $conexion = new ConexionBD();
    //Faltan los real_escape_string

    $persona = $conexion->inicioSesionPersona($contraseña);

    // Comprobar que se ha iniciado sesión correctamente 
    if (!is_null($persona)) 
    {
      $_SESSION['persona'] = $persona;
    } 
    else 
    {
      $variablesParaTwig['correcto'] = false;
    }
  }

  if (isset($_SESSION['persona']))
  {
    header("Location: principalPersonas.php");
  }

  echo $twig->render('loginPersonas.html', $variablesParaTwig);

?>
