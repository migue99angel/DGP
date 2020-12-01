<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();

  if(isset($_SESSION['facilitador'])) {
    $conexion = new ConexionBD();
    $ejercicios = $conexion->cargarEjerciciosResueltos();
  } else {
    exit();
  }

  if(isset($_GET['corregido']) && isset($_GET['idEjercicio']) && isset($_GET['idPersona'])) {
    if($_GET['corregido'] == true && ctype_digit($_GET['idEjercicio']) && ctype_digit($_GET['Ejercicio'])) {
      $idEjercicio = htmlspecialchars($_GET['idEjercicio']);
      $idPersona = htmlspecialchars($_GET['idPersona'])
    } else {
      exit();
    }
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['comentario']) && !empty($_POST['comentario']) && is_string($_POST['comentario']) &&
        isset($_POST['valoracion']) && !empty($_POST['valoracion']) && ctype_digit($_POST['valoracion'] &&
        isset($_FILES['multimedia']) && !empty($_FILES['multimedia']))) 
        {

          $comentario = htmlspecialchars($_POST['comentario']);
          $valoracion = htmlspecialchars($_POST['valoracion']);

          $file_name = $_FILES['imagen']['name'];
          $file_size = $_FILES['imagen']['size'];
          $file_tmp = $_FILES['imagen']['tmp_name'];
          $file_type = $_FILES['imagen']['type'];
          $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
          
          $extensions= array("jpeg","jpg","png","mp3","mp4","mov");

          $rutaFichero = "img/" . $file_name;

          if(in_array($file_ext,$extensions) === true && $file_size < 2097152){
            move_uploaded_file($file_tmp, $rutaFichero);
          }

          $conexion->corregirEjercicio($idEjercicio, $_SESSION['facilitador']->getidFacilitador(), $idPersona, $comentario, $rutaFichero, $valoracion);

          header("Location: listaEjercicios.php");
        }
  }

  $variablesParaTwig = [];

  echo $twig->render('corregirEjercicio.html', $variablesParaTwig);

  ?>
