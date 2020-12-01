<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];

  // Contraseña de la persona
  $contraseña = "";

  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['persona']))
  {
    $conexion = new ConexionBD();
    //Faltan los real_escape_string
    $_SESSION['persona'] = $conexion->inicioSesionPersona($contraseña);


    /*if (strlen($contraseña) == 3)
    {
      $conexion = new ConexionBD();
      //Faltan los real_escape_string
      $_SESSION['persona'] = $conexion->inicioSesionPersona($contraseña);
    } else {
      // Añadir pictograma pulsado a la contraseña
      switch ((string) $_POST['Pictograma'])
      {
        case '1':
          $contraseña .= '1';
          break;

        case '2':
          $contraseña .= '2';
          break;

        case '3':
          $contraseña .= '3';
          break;

        case '4':
          $contraseña .= '4';
          break;

        case '5':
          $contraseña .= '5';
          break;

        case '6':
          $contraseña .= '6';
          break;

        case '7':
          $contraseña .= '7';
          break;

        case '8':
          $contraseña .= '8';
          break;

        case '9':
          $contraseña .= '9';
          break;
      }
    }*/
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['persona']))
  {
    $_SESSION['persona'] = null;
  }

  if (isset($_SESSION['persona']))
  {
    header("Location: principalPersonas.php");
  }

  echo $twig->render('loginPersonas_PlaceHolder.html', $variablesParaTwig);

?>
