<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "./modelo/conexionBD.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $conexion = new ConexionBD();
    $dir = './data/upload/';

    $variablesParaTwig['botonAtras'] = true;
    $variablesParaTwig['paginaAnterior'] = "listaEjercicios.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        if ($_FILES['multimedia']['size'] > 0)
        {
            $multimedia = $_FILES['multimedia']['name'];
            if (move_uploaded_file($_FILES['multimedia']['tmp_name'], $dir . basename($_FILES['multimedia']['name'])))
            {
                $res = $conexion->resolverEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio(),$_SESSION['persona']->getIdPersona(),$_SESSION['ejercicioAsignado']->getFechaAsignacion(),$_POST['comentario'],$_POST['valoracion'], $dir . $_FILES['multimedia']['name']);
            }
            else
            {
                $variablesParaTwig['errores'] = array('No se ha podido resolver el ejercicio');
            }
        }

    }

    if (isset($_SESSION['ejercicioAsignado']))
    {
        $variablesParaTwig['idEjercicio'] = $_SESSION['ejercicioAsignado']->getIdEjercicio();
        $variablesParaTwig['idPersona'] = $_SESSION['persona']->getIdPersona();
        $variablesParaTwig['ejercicio'] = $conexion->cargarEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio());
        $ejercicio = $conexion->cargarEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio());
        $variablesParaTwig['ejercicio'] = $ejercicio;
        $variablesParaTwig['enunciado'] = $conexion->getEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio());
        $variablesParaTwig['asigna'] = $_SESSION['ejercicioAsignado'];



        //Pueden darse 3 casos
        // 0 - > El ejercicio está asignado pero no está resuelto
        // 1 - > El ejercicio está resuelto, pero no está corregido
        // 2 - > El ejercicio está resuelto y corregido

        // ¡CUIDADO! La clave primaria de Resuelve_Asigna tiene más campos
        $variablesParaTwig['estado'] = $conexion->obtenerEstadoEjercicio($variablesParaTwig['idEjercicio'],$_SESSION['persona']->getIdPersona());
        //Si el ejercicio está corregido tenemos que acceder a la base de datos para obtener las calificaciones
        if($variablesParaTwig['estado'] == 2)
        {
            $variablesParaTwig['correccion'] = $conexion->cargarCorreccionEjercicio($_SESSION['ejercicioAsignado']->getIdEjercicio(),$_SESSION['persona']->getIdPersona());
        }
    }
    else {
        $variablesParaTwig['errores'] = array('No se ha podido cargar el ejercicio');
    }

    var_dump($variablesParaTwig['estado']);

    echo $twig->render('mostrarEjercicio.html', $variablesParaTwig);

?>
