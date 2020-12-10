<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "./modelo/conexionBD.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $conexion = new ConexionBD();

    $variablesParaTwig['botonAtras'] = true;
    $variablesParaTwig['paginaAnterior'] = "listaEjercicios.php";

    $vieneDePost = NULL;

    if (isset($_POST['idEjercicio'])) {
        $vieneDePost = true;
    } else if (isset($_SESSION['ejercicioAsignado'])) {
        $vieneDePost = false;
    } else {
        $variablesParaTwig['errores'] = array('No se ha podido cargar el ejercicio');
    }

    if ($vieneDePost !== NULL) {
        if ($vieneDePost) {
            $_SESSION['ejercicioAsignado'] = new Asigna($_POST['idEjercicio'],$_POST['idFacilitador'],
                                             $_SESSION['persona']->getIdPersona(),$_POST['fechaAsignacion']);

            $variablesParaTwig['idEjercicio'] = $_POST['idEjercicio'];
            // Por si sirve
            $ejercicio = $conexion->cargarEjercicio($_POST['idEjercicio']);
        } else {
            $variablesParaTwig['idEjercicio'] = $_SESSION['ejercicioAsignado']->getIdEjercicio();
            // Por si sirve
            $ejercicio = $conexion->cargarEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio());
        }
    }

    echo $twig->render('mostrarEjercicio.html', $variablesParaTwig);

?>
