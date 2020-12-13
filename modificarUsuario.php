<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];
  $conexion = new ConexionBD();
  session_start();

  $variablesParaTwig['tipoUsuario'] = $_GET['tipoUsuario'];
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "administracion.php?tipoUsuario=" . $_GET['tipoUsuario'];


  if (isset($_SESSION['admin']) && isset($_GET['id']))
  {
    if($_GET['tipoUsuario'] == "Persona")
    {
      $persona = $conexion->cargarPersona($_GET['id']);
      $variablesParaTwig['nombre'] = $persona->getNombre();
      $variablesParaTwig['telefono'] = $persona->getTlfPersona();
      $variablesParaTwig['id'] = $persona->getIdPersona();
    }
    else if($_GET['tipoUsuario'] == "Facilitador")
    {
      $facilitador = $conexion->cargarFacilitador($_GET['id']);
      $variablesParaTwig['nombre'] = $facilitador->getnombreFacilitador();
      $variablesParaTwig['telefono'] = $facilitador->getTelefono();
      $variablesParaTwig['id'] = $facilitador->getidFacilitador();
    }
    else if($_GET['tipoUsuario'] == "Administrador")
    {    
      $administrador = $conexion->cargarAdministrador($_GET['id']);
      $variablesParaTwig['nombre'] = $administrador->getNombre();
      $variablesParaTwig['telefono'] = $administrador->getTelefono();
      $variablesParaTwig['id'] = $administrador->getIdAdministrador();
    }
  }
 

  if ( isset($_SESSION['admin']) && isset($_POST['nombre']))
  {
    if($variablesParaTwig['tipoUsuario'] == "Persona")
    {
      $conexion->modificarPersona($_POST['id'],$_POST['usuario'],$_POST['telefono'],$_POST['contraseña']);
    }
    else if($variablesParaTwig['tipoUsuario'] == "Facilitador")
    {
      $conexion->modificarFacilitador($_POST['id'],$_POST['usuario'],$_POST['telefono'],$_POST['contraseña']);
    }
    else if($variablesParaTwig['tipoUsuario'] == "Administrador")
    {
      $conexion->modificarAdministrador($_POST['id'],$_POST['usuario'],$_POST['telefono'],$_POST['contraseña']);
    }

    //header("Location: " .$variablesParaTwig['paginaAnterior'] );
  }

  echo $twig->render('modificarUsuario.html', $variablesParaTwig);

?>