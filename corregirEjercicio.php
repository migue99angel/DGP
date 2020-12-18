<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();

  if(isset($_SESSION['facilitador'])) {
    $conexion = new ConexionBD();

  } else {
    exit();
  }

  if(isset($_GET['idEjercicio']) && isset($_GET['idPersona'])) {
    if(ctype_digit($_GET['idEjercicio']) && ctype_digit($_GET['idPersona'])) {
      $idEjercicio = htmlspecialchars($_GET['idEjercicio']);
      $idPersona = htmlspecialchars($_GET['idPersona']);
      $ejercicio = $conexion->cargarEjercicioResueltoPorID($_GET['idEjercicio'], $_GET['idPersona']);
      //Cargamos los datos del autor del ejercicio para mostrar su información en la pantalla de corrección
      $autor = $conexion->cargarPersona( $_GET['idPersona']);
      $enunciado = $conexion->getEjercicio($_GET['idEjercicio']);
    } else {
      exit();
    }
  }
  $multimedia = false;
  if(isset($_GET['corregido']) && $_GET['corregido'] == true) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if((isset($_POST['comentario']) && !empty($_POST['comentario']) && is_string($_POST['comentario'])) ||
          isset($_POST['valoracion']) && !empty($_POST['valoracion']) && is_string($_POST['valoracion']) )
          {
              
              $comentario = htmlspecialchars($_POST['comentario']);
              $valoracion = htmlspecialchars($_POST['valoracion']);
              if( isset($_FILES['multimedia']) && !empty($_FILES['multimedia'])) 
              {
                $multimedia=true;
                $file_name = $_FILES['multimedia']['name'];
                $file_size = $_FILES['multimedia']['size'];
                $file_tmp = $_FILES['multimedia']['tmp_name'];
                $file_type = $_FILES['multimedia']['type'];
                $file_ext = strtolower(end(explode('.',$_FILES['multimedia']['name'])));
                
                $extensions= array("jpeg","jpg","png","mp3","mp4","mov");
      
                $rutaFichero = 'data/upload/'. $file_name;
                
              
                if(in_array($file_ext,$extensions) === true && $file_size < 2097152){
                  move_uploaded_file($file_tmp, $rutaFichero);
                }    
              
            }

            if(!empty($_POST['comentario']) || $multimedia == true)
              $res = $conexion->corregirEjercicio($idEjercicio, $_SESSION['facilitador']->getidFacilitador(), $idPersona, $comentario, $rutaFichero, $valoracion);

            if($res)
              header("Location: listaEjercicios.php");
          }
    }
  }

  $paginaAnterior = 'listaEjercicios.php';
  $variablesParaTwig = ['ejercicio' => $ejercicio, 'idEjercicio' => $_GET['idEjercicio'], 'idPersona' => $_GET['idPersona'], 'autor' => $autor,
  'enunciado' => $enunciado, 'botonAtras' => true, 'paginaAnterior' => $paginaAnterior];

  echo $twig->render('corregirEjercicio.html', $variablesParaTwig);

  ?>
