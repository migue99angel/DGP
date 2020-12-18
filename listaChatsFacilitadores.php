<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $conexion = new ConexionBD();
  $variablesParaTwig = array();

  session_start();

  $variablesParaTwig['botonAtras'] = True;
  $variablesParaTwig['paginaAnterior'] = 'pricipalFacilitador.php';

  if (isset($_SESSION['facilitador'])) {
      $ejercicios = $conexion->cargarEjerciciosAsignadosPorFacilitador($_SESSION['facilitador']->getIdFacilitador());
  }

  $i = 0;
  $numEjercicios = count($ejercicios);
  $ejerciciosOrdenados = array();

  while ($i < $numEjercicios) {
    $titulo = $ejercicios[$i]->getTitulo();
    $ejerciciosOrdenados[] = array(
      'titulo' => $titulo,
      'ejercicios' => array()
    );
    $aumentar = true;

    while ($i < $numEjercicios && $titulo == $ejercicios[$i]->getTitulo()) {
      $ejerciciosOrdenados[count($ejerciciosOrdenados)-1]['ejercicios'][] = $ejercicios[$i];
      $i++;
      $aumentar = false;
    }
    if ($aumentar)
      $i++;
  }

  $variablesParaTwig['ejerciciosOrdenados'] = $ejerciciosOrdenados;

  echo $twig->render("listaChatsFacilitadores.html",$variablesParaTwig);

  ?>
