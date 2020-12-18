<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "./modelo/conexionBD.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $conexion = new ConexionBD();

    $variablesParaTwig['botonAtras'] = true;
    $variablesParaTwig['paginaAnterior'] = isset($_SESSION['persona']) ? "mostrarEjercicio.php" : "listaChatsFacilitadores.php";

    // Funcionalidades principales
    if (isset($_SESSION['ejercicioAsignado'])) {
        $idEjercicio     = $_SESSION['ejercicioAsignado']->getIdEjercicio();
        $idPersona       = $_SESSION['ejercicioAsignado']->getIdPersona();
        $idFacilitador   = $_SESSION['ejercicioAsignado']->getIdFacilitador();
        $fechaAsignacion = $_SESSION['ejercicioAsignado']->getFechaAsignacion();

        $chat = $conexion->cargarChat($idEjercicio,$idPersona,$idFacilitador,$fechaAsignacion);

        if ($chat->getIdChat() == null || $chat->getIdChat() < 1) {
            $chatCreado = $conexion->crearChat($idEjercicio,$idPersona,$idFacilitador,$fechaAsignacion);

            if ($chatCreado) {
                $chat = $conexion->cargarChat($idEjercicio,$idPersona,$idFacilitador,$fechaAsignacion);
            }
        }

        // Si falla la carga del chat, no podemos seguir
        if ($chat->getIdChat() == null || $chat->getIdChat() < 1) {
            $variablesParaTwig['errores'] = array('Error al cargar el chat');
        // Pero si se carga con éxito, se lo pasamos a twig
        } else {
            $variablesParaTwig['mensajes'] = $chat->parseChat();
            $variablesParaTwig['usuarioActual'] = array(
                'tipo' => (isset($_SESSION['persona'])) ? 'persona' : 'facilitador'
            );
            // Poner datos del chat en la sesión para luego poder actualizarlo
            $_SESSION['chat'] = $chat;
        }
    ////////////////////////////////////////////////////////////////////////////////////////////
    } else {
        $variablesParaTwig['errores'] = array('Primero debe seleccionar un ejercicio asignado');
    }

    echo $twig->render('mostrarChat.html', $variablesParaTwig);

?>
