<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "./modelo/conexionBD.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $conexion = new ConexionBD();

    $variablesParaTwig['botonAtras'] = true;
    $variablesParaTwig['paginaAnterior'] = "listaEjercicios.php";

    if (isset($_SESSION['ejercicioAsignado'])) {
        $variablesParaTwig['idEjercicio'] = $_SESSION['ejercicioAsignado']->getIdEjercicio();
        $ejercicio = $conexion->cargarEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio());
        var_dump($ejercicio);
        $variablesParaTwig['ejercicio'] = $ejercicio;
        $variablesParaTwig['enunciado'] = $conexion->getEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio());

  

        //Pueden darse 3 casos
        // 0 - > El ejercicio está asignado pero no está resuelto
        // 1 - > El ejercicio está resuelto, pero no está corregido
        // 2 - > El ejercicio está resuelto y corregido
        $estadoEjercicio = $conexion->obtenerEstadoEjercicio($variablesParaTwig['idEjercicio'],$_SESSION['persona']->getIdPersona());
        switch($estadoEjercicio)
        {
            case 0:
            break;

            case 1:
            break;

            case 2:
            break;
        }
    } else {
        $variablesParaTwig['errores'] = array('No se ha podido cargar el ejercicio');
    }



    echo $twig->render('mostrarEjercicio.html', $variablesParaTwig);

?>
