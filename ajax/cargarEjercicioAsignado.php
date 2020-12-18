<?php

require_once "../modelo/conexionBD.php";

session_start();

$conexion = new conexionBD();

$respuesta = array(
    'exito' => false
);

if (isset($_POST)) {
    if (isset($_POST['idFacilitador'])) {
        $_SESSION['ejercicioAsignado'] = $conexion->getEjercicioAsignado($_POST['idEjercicio'],$_SESSION['persona']->getIdPersona(),$_POST['fechaAsignacion'],$_POST['idFacilitador']);
         /*new Asigna($_POST['idEjercicio'],$_POST['idFacilitador'],
                                             $_SESSION['persona']->getIdPersona(),$_POST['fechaAsignacion']);*/
    } else {
        $_SESSION['ejercicioAsignado'] = $conexion->getEjercicioAsignado($_POST['idEjercicio'],$_POST['idPersona'],$_POST['fechaAsignacion'],$_SESSION['facilitador']->getidFacilitador());
        /*new Asigna($_POST['idEjercicio'],$_SESSION['facilitador']->getidFacilitador(),
                                             $_POST['idPersona'],$_POST['fechaAsignacion']);*/
    }
    if ($_SESSION['ejercicioAsignado'] !== NULL) {
        $respuesta['exito'] = true;
    }
}

echo json_encode($respuesta);

?>
