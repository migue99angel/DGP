<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $variablesParaTwig = [];

  session_start();

  if(isset($SESSION['facilitador'])) {
    $conexion = new ConexionBD();
    $personas = $conexion->getAllPersonas();
  }

  if($_SERVER['REQUEST_METHOD'] === "POST"){
    $idGrupo = $_POST['id'];
    $nombreGrupo = $_POST['nombre'];
    $participantesGrupo = $_POST['participantes']
    $conexion->crearGrupo($idGrupo,$nombreGrupo,$participantesGrupo);
  }

  echo $twig->render('crearGrupo.html', $variablesParaTwig);

?>
