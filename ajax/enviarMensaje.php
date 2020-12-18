<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once "../modelo/conexionBD.php";

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader);

session_start();

$variablesParaTwig = array();

$respuesta = array(
    'exito' => false
);

if (isset($_POST)) {
    if (isset($_POST['mensaje'])) {
        if (isset($_SESSION['chat'])) {
            // Capturamos los datos del mensaje que nos envía JS
            $mensaje = json_decode($_POST['mensaje']);
            // Completamos el mensaje con los campos necesarios
            $esPersona = isset($_SESSION['persona']);
            $mensaje->emisor = new stdClass();
            $mensaje->emisor->tipo = $esPersona ? 'persona' : 'facilitador';
            $mensaje->emisor->id = $esPersona ? $_SESSION['persona']->getIdPersona() : $_SESSION['facilitador']->getIdFacilitador();
            $mensaje->emisor->nombre = $esPersona ? $_SESSION['persona']->getNombre() : $_SESSION['facilitador']->getnombreFacilitador();

            $mensaje->fechaEmision = date('Y-m-d H:i:s');
            $mensajes = $_SESSION['chat']->addMensaje($mensaje);

            if ($mensajes !== null) {
                $variablesParaTwig['mensajes'] = $mensajes;
                $variablesParaTwig['usuarioActual'] = array(
                    'tipo' => (isset($_SESSION['persona'])) ? 'persona' : 'facilitador'
                );

                $respuesta['exito'] = true;
                $respuesta['mensajes'] = $twig->render("contenedorMensajes.html",$variablesParaTwig);
            }
        }
    }
}

echo json_encode($respuesta);

?>
