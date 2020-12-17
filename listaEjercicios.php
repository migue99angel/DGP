<?php

  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "./modelo/conexionBD.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $conexion = new ConexionBD();
  $variablesParaTwig = array();

  $variablesParaTwig['botonAtras'] = True;


  if(isset($_SESSION['facilitador'])) {
    $variablesParaTwig['paginaAnterior'] = 'principalFacilitador.php';

    $ejercicios = $conexion->cargarEjerciciosResueltos($_SESSION['facilitador']->getidFacilitador());
    $esFacilitador = true;

    // Lo he puesto así porque esto ahora añade al final
    // y no sobreescribe lo que ya hay
    $variablesParaTwig['ejercicios'] = $ejercicios;
    $variablesParaTwig['esFacilitador'] = true;

  } else if (isset($_SESSION['persona'])) {
      $variablesParaTwig['nombrePersona'] = $_SESSION['persona']->getNombre();
      if (!isset($_POST['diaSemana'])) {
        $variablesParaTwig['paginaAnterior'] = 'principalPersonas.php';
      } else {
        $variablesParaTwig['paginaAnterior'] = 'listaEjercicios.php';

        $variablesParaTwig['esListado'] = true;
        $variablesParaTwig['diaSemana'] = $_POST['diaSemana'];
        $diasSemana = array(
          'lunes'     => 0,
          'martes'    => 1,
          'miercoles' => 2,
          'jueves'    => 3,
          'viernes'   => 4,
          'sabado'    => 5,
          'domingo'   => 6
        );
        $variablesParaTwig['ejercicios'] = $conexion->cargarEjerciciosPersona($_SESSION['persona']->getIdPersona(),
                                                                              $diasSemana[$_POST['diaSemana']]);
      }
  }

  echo $twig->render('listaEjercicios.html', $variablesParaTwig);

?>
