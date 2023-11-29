
<?php
require_once("../bd/Conexion.php");
require_once("../models/ConsultasAjax.php");

// instancia consultajax
$consultas = new ConsultasAjax();
$idventa = $_POST['idventa'];
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {


    $registroVentas = $consultas->ObtenerFullRegistroVentas($idventa);




    echo json_encode($registroVentas);
} else {
    header("Location:" .  "http://localhost/SistemaGestionVentas/");
}
?>