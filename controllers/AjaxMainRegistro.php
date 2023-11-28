
<?php
require_once("../bd/Conexion.php");
require_once("../models/ConsultasAjax.php");

// instancia consultajax
$consultas = new ConsultasAjax();

// recolectando la data
$telefono = $_POST["telefono"];
$tipo_de_documento = $_POST["tipoDocumento"];
$nro_de_documento = $_POST["nroDocumento"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];

$tipo_de_plan = $_POST["tipoPlan"];
$nivel_1 = $_POST["nivel1"];
$nivel_2 = $_POST["nivel2"];
$nivel_3 = $_POST["nivel3"];
$nsn = ($_POST["nrosn"] == "Si") ? 1 : 0; // Convert "Si" to 1 and "No" to 0
$activacion_inmediata = ($_POST["activacionInmediata"] == "Si") ? 1 : 0; // Convert "Si" to 1 and "No" to 0
$observaciones = $_POST["observaciones"];
$idUsuario = $_POST["idUsuario"];
echo $idUsuario;
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {



    $consultas->RegistrarCliente($telefono, $tipo_de_documento, $nro_de_documento, $nombres, $apellidos);
    $consultas->RegistrarVentaDetalles($tipo_de_plan, $nivel_1, $nivel_2, $nivel_3, $nsn, $activacion_inmediata, $observaciones);


    $estado_venta_id = 1;
    $estado_backoffice_id = 1;
    $cliente_id  = $consultas->ObtenerUltimoClienteId();
    $venta_detalles_id = $consultas->ObtenerUltimoVentaDetalleId();
    $consultas->RegistrarVenta($idUsuario, $estado_venta_id, $estado_backoffice_id, $cliente_id, $venta_detalles_id);




    echo json_encode(1);
} else {
    header("Location:" .  "http://localhost/SistemaGestionVentas/");
}
?>