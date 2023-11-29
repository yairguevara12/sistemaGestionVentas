
<?php
require_once("../bd/Conexion.php");
require_once("../models/ConsultasAjax.php");

// instancia consultajax
$consultas = new ConsultasAjax();
$fechaInicio = $_POST['fechainicio'];
$fechaFin = $_POST['fechafinal'];
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {


    $registroVentas = $consultas->obtenerRegistroVentabyfecha($fechaInicio, $fechaFin);




    echo json_encode($registroVentas);
} else {
    header("Location:" .  "http://localhost/SistemaGestionVentas/");
}
?>