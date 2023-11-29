
<?php
require_once("../bd/Conexion.php");
require_once("../models/ConsultasAjax.php");

// instancia consultajax
$consultas = new ConsultasAjax();



// recolectan do la data
$venta_id  = $_POST["venta_id"];
$planBase = $_POST["planBase"];
$ciclo = $_POST["ciclo"];
$planAMigrar = $_POST["planAMigrar"];
$departamento = $_POST["departamento"];
$tipoDeFc = $_POST["tipoDeFc"];

$tipoDeVenta = $_POST["tipoDeVenta"];
$estadoDeVenta = $_POST["estadoDeVenta"];;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {




    $consultas->updateVentaDetalleSeguimientoVenta(

        $venta_id,
        $planBase,
        $ciclo,
        $planAMigrar,
        $departamento,
        $tipoDeFc,
        $tipoDeVenta,
        $estadoDeVenta
    );




    echo json_encode(1);
} else {
    header("Location:" .  "http://localhost/SistemaGestionVentas/");
}
?>