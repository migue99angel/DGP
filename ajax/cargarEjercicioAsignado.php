<?php

require_once "../modelo/conexionBD.php";

session_start();

$respuesta = array(
    'exito' => false
);

if (isset($_POST)) {
    if (isset($_POST['idFacilitador'])) {
        $_SESSION['ejercicioAsignado'] = new Asigna($_POST['idEjercicio'],$_POST['idFacilitador'],
                                             $_SESSION['persona']->getIdPersona(),$_POST['fechaAsignacion']);
    } else {
        $_SESSION['ejercicioAsignado'] = new Asigna($_POST['idEjercicio'],$_SESSION['facilitador']->getidFacilitador(),
                                             $_POST['idPersona'],$_POST['fechaAsignacion']);
    }
    if ($_SESSION['ejercicioAsignado'] !== NULL) {
        $respuesta['exito'] = true;
    }
}

echo json_encode($respuesta);

?>
