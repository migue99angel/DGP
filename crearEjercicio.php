<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();
  
  if (!isset($_SESSION['facilitador'])) {
    exit();
  }
  
  $variablesParaTwig['mostrarResultado'] = false;
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new ConexionBD();
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_FILES["imagen"]["name"];
    if (isset($_FILES["multimedia"]["name"])) {
      $multimedia = $_FILES["multimedia"]["name"];
      $res = $conexion->crearEjercicioMultimedia($_SESSION['facilitador']->getidFacilitador(), $titulo, $descripcion, $imagen, $multimedia);
      echo $res;
    } else {
      $res = $conexion->crearEjercicio($_SESSION['facilitador']->getidFacilitador(), $titulo, $descripcion, $imagen);
      echo $res;
    }
    $variablesParaTwig['mostrarResultado'] = true;
    $variablesParaTwig['resultado'] = $res;
  }
  
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

  echo $twig->render('crearEjercicio.html', $variablesParaTwig);

?>
