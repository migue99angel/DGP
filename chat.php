<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "./modelo/conexionBD.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $conexion = new ConexionBD();

    $variablesParaTwig['botonAtras'] = true;
    $variablesParaTwig['paginaAnterior'] = "mostrarEjercicio.php";

    echo $twig->render('chat.html', $variablesParaTwig);

?>
