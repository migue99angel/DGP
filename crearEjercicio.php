<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  session_start();
  
  if (!isset($_SESSION['facilitador'])) {
    exit();
  }
  
  /*
  sudo chown -R www-data www/data
  sudo chmod -R g+rwX www/data
  */
  
  $dir = './data/upload/';
  $variablesParaTwig['mostrarResultado'] = false;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexion = new ConexionBD();
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];
    if ($_FILES['multimedia']['size'] > 0) {
      $multimedia = $_FILES['multimedia']['name'];
      $res = $conexion->crearEjercicioMultimedia($_SESSION['facilitador']->getidFacilitador(), $titulo, $descripcion, $dir . $imagen, $dir . $multimedia);
      if ($res && move_uploaded_file($_FILES['imagen']['tmp_name'], $dir . basename($_FILES['imagen']['name'])) && move_uploaded_file($_FILES['multimedia']['tmp_name'], $dir . basename($_FILES['multimedia']['name']))) {
        $res = true;
      } else {
        $res = false;
      }
    } else {
      $res = $conexion->crearEjercicio($_SESSION['facilitador']->getidFacilitador(), $titulo, $descripcion, $dir . $imagen);
      if ($res && move_uploaded_file($_FILES['imagen']['tmp_name'], $dir . basename($_FILES['imagen']['name']))) {
        $res = true;
      } else {
        $res = false;
      }
    }
    $variablesParaTwig['mostrarResultado'] = true;
    $variablesParaTwig['resultado'] = $res;
  }
  
  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

  echo $twig->render('crearEjercicio.html', $variablesParaTwig);

?>
