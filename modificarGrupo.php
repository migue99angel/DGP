<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $conexion = new ConexionBD();
  session_start();
  $variablesParaTwig = [];
  $variablesParaTwig['id'] = $_GET['id'];

  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "administracionGrupo.php";



  if ( isset($_POST['nombre']))
  {

    $conexion->modificarGrupo($_POST['id'],$_POST['nombre']);
 }

 if ( isset($_POST['eliminacion']))
 {
   if (isset($_POST['elementos'])) {
     foreach ($_POST['elementos'] as $personas) {
       $conexion->eliminarDeGrupo($_GET['id'],$personas);
     }
   }
 }

 if ( isset($_POST['adicion']))
 {
   if (isset($_POST['elementosNuevos'])) {
     foreach ($_POST['elementosNuevos'] as $personas) {
       $conexion->asignarGrupo($_GET['id'],$personas);
     }
   }
 }

 $grupo = $conexion->cargarGrupo($_GET['id']);
 $variablesParaTwig['nombre'] = $grupo->getNombreGrupo();
 $variablesParaTwig['pertenece'] = $conexion->cargarPersonasGrupo($_GET['id']);
 $variablesParaTwig['personas'] = $conexion->cargarPersonasFueraGrupo($_GET['id']);


  echo $twig->render('modificarGrupo.html', $variablesParaTwig);

?>
