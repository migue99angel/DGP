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

$mensajes = $_SESSION['chat']->parseChat($mensaje);

if ($mensajes !== null) {
    $variablesParaTwig['mensajes'] = $mensajes;
    $variablesParaTwig['usuarioActual'] = array(
        'tipo' => (isset($_SESSION['persona'])) ? 'persona' : 'facilitador'
    );

    $respuesta['exito'] = true;
    $respuesta['mensajes'] = $twig->render("contenedorMensajes.html",$variablesParaTwig);
}

echo json_encode($respuesta);

?>
