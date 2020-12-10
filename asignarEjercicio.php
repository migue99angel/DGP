<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();

  $variablesParaTwig = [];

  $variablesParaTwig['botonAtras'] = True;

  //var_dump($_SESSION);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($_POST);
  }

  $conexion = new ConexionBD();

  if (!isset($_POST['numeroOcultos'])) {
    unset($_SESSION['ejerciciosAsignar']);

    $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

    $variablesParaTwig['lista'] = array(
      'accionCheckbox' => 'asignarEjercicio.php',
      'idCheckbox'     => 'listaEjercicios',
      'encCheckbox'    => 'multipart/form-data',
      'tituloLista'    => 'Lista de Ejercicios',
      'elementos'      => $conexion->getAllEjercicios(),
      'numeroOcultos'  => 1,
      'inputOcultos'   => array('listaPersonas'),
      'valorSubmitCheckbox' => 'Siguiente'
    );

    $variablesParaTwig['tipoLista'] = 'ejercicios';

  } else if (isset($_POST['oculto0']) && $_POST['oculto0'] == 'listaPersonas') {
    $ejerciciosAsignar = array();

    if (isset($_POST['elementos'])) {
      foreach ($_POST['elementos'] as $ejercicio) {
        $ejerciciosAsignar[] = $ejercicio;
      }
      $_SESSION['ejerciciosAsignar'] = $ejerciciosAsignar;
    } else {
      $variablesParaTwig['errores'] = array('No se han seleccionado ejercicios');
    }

    $variablesParaTwig['paginaAnterior'] = 'asignarEjercicio.php';

    $variablesParaTwig['lista'] = array(
      'accionCheckbox' => 'asignarEjercicio.php',
      'idCheckbox'     => 'listaPersonas',
      'encCheckbox'    => 'multipart/form-data',
      'tituloLista'    => 'Lista de Personas',
      'elementos'      => $conexion->getAllPersonas(),
      'numeroOcultos'  => 1,
      'inputOcultos'   => array('asignarEjercicios'),
      'valorSubmitCheckbox' => 'Asignar a estas Personas'
    );

    $variablesParaTwig['listaGrupos'] = array(
      'accionCheckbox' => 'asignarEjercicio.php',
      'idCheckbox'     => 'listaGrupos',
      'encCheckbox'    => 'multipart/form-data',
      'tituloLista'    => 'Lista de Grupos',
      'elementos'      => $conexion->getAllGrupos(),
      'numeroOcultos'  => 2,
      'inputOcultos'   => array('asignarEjercicios','asignarGrupos'),
      'valorSubmitCheckbox' => 'Asignar a estos Grupos'
    );

    $variablesParaTwig['tipoLista'] = 'personas';

  } else if (isset($_POST['oculto0']) && $_POST['oculto0'] == 'asignarEjercicios') {
    if (isset($_SESSION['ejerciciosAsignar'])) {

      foreach ($_SESSION['ejerciciosAsignar'] as $ejercicio) {
        foreach ($_POST['elementos'] as $persona) {

          if (isset($_POST['oculto1']) && $_POST['oculto1'] == 'asignarGrupos') {
            $exito = $conexion->asignarEjercicioGrupo($ejercicio,$_SESSION['facilitador']->getIdFacilitador(),
                                                      $persona,$_POST['fechaGrupo'.trim($persona)]);
          } else {
            $exito = $conexion->asignarEjercicioPersona($ejercicio,$_SESSION['facilitador']->getIdFacilitador(),
                                                        $persona,$_POST['fecha'.trim($persona)]);
          }

          if ($exito) {
            $variablesParaTwig['exito'] = $exito;
          } else {
            $variablesParaTwig['errores'] = array('No se han podido asignar los ejercicios');
          }

        }
      }

    } else {
      $variablesParaTwig['errores'] = array('Error de la página, no se han podido asignar los ejercicios');
    }
  }

  echo $twig->render('asignarEjercicio.html', $variablesParaTwig);

  ?>
