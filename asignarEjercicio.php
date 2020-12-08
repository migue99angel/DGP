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
    $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';
    $variablesParaTwig['accionCheckbox'] = 'asignarEjercicio.php';
    $variablesParaTwig['idCheckbox'] = 'listaEjercicios';
    $variablesParaTwig['encCheckbox'] = 'multipart/form-data';
    $variablesParaTwig['tituloLista'] = 'Lista de Ejercicios';

    $variablesParaTwig['tipoLista'] = 'ejercicios';

    $variablesParaTwig['elementos'] = $conexion->getAllEjercicios();

    $variablesParaTwig['numeroOcultos'] = 1;
    $variablesParaTwig['inputOcultos'] = array('listaPersonas');

    $variablesParaTwig['valorSubmitCheckbox'] = 'Siguiente';
  } else if (isset($_POST['oculto0']) && $_POST['oculto0'] == 'listaPersonas') {
    $variablesParaTwig['paginaAnterior'] = 'asignarEjercicio.php';
    $variablesParaTwig['accionCheckbox'] = 'asignarEjercicio.php';
    $variablesParaTwig['idCheckbox'] = 'listaPersonas';
    $variablesParaTwig['encCheckbox'] = 'multipart/form-data';
    $variablesParaTwig['tituloLista'] = 'Lista de Personas';

    $variablesParaTwig['tipoLista'] = 'personas';

    $variablesParaTwig['elementos'] = array(
      array(
        'nombre' => 'Benito Camela',
        'tlfPersona' => '666666666'
      )
    );

    $variablesParaTwig['valorSubmitCheckbox'] = 'Asignar';
  }

  echo $twig->render('asignarEjercicio.html', $variablesParaTwig);

  ?>
