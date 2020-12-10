<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();

  if (isset($_POST)) {
      // Esto sólo es de prueba, se puede borrar perfectamente
      if (isset($_POST['idEjercicio'])) {
          $variablesParaTwig['idEjercicio'] = $_POST['idEjercicio'];
      }
      //////////////////////////////////////////////////
  }

  $variablesParaTwig['botonAtras'] = true;
  $variablesParaTwig['paginaAnterior'] = "listaEjercicios.php";

  echo $twig->render('mostrarEjercicio.html', $variablesParaTwig);

?>
