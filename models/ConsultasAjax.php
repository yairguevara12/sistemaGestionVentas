<?php
class ConsultasAjax
{

    private $Conexion = "";

    function __construct()
    {

        $this->Conexion = new Conexion();
    }
    function RegistrarCliente($telefono, $tipo_de_documento, $nro_de_documento, $nombres, $apellidos)
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("insert INTO cliente(telefono, tipo_de_documento, nro_de_documento, nombres, apellidos) VALUES (?, ?, ?, ?, ?)");
        $cadenasql->bindParam(1, $telefono, PDO::PARAM_STR);
        $cadenasql->bindParam(2, $tipo_de_documento, PDO::PARAM_STR);
        $cadenasql->bindParam(3, $nro_de_documento, PDO::PARAM_STR);
        $cadenasql->bindParam(4, $nombres, PDO::PARAM_STR);
        $cadenasql->bindParam(5, $apellidos, PDO::PARAM_STR);
        $SeGuardo = $cadenasql->execute();
        $resultado = $cadenasql->fetch(PDO::FETCH_ASSOC);
        return $SeGuardo;
        $this->Conexion->CerrarConexion();
    }
    function RegistrarVentaDetalles($tipo_de_plan, $nivel_1, $nivel_2, $nivel_3, $nsn, $activacion_inmediata, $observaciones)
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("insert INTO venta_detalles(tipo_de_plan, nivel_1, nivel_2, nivel_3, nsn, activacion_inmediata, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $cadenasql->bindParam(1, $tipo_de_plan, PDO::PARAM_STR);
        $cadenasql->bindParam(2, $nivel_1, PDO::PARAM_STR);
        $cadenasql->bindParam(3, $nivel_2, PDO::PARAM_STR);
        $cadenasql->bindParam(4, $nivel_3, PDO::PARAM_STR);
        $cadenasql->bindParam(5, $nsn, PDO::PARAM_STR);
        $cadenasql->bindParam(6, $activacion_inmediata, PDO::PARAM_BOOL);
        $cadenasql->bindParam(7, $observaciones, PDO::PARAM_STR);
        $SeGuardo = $cadenasql->execute();
        $resultado = $cadenasql->fetch(PDO::FETCH_ASSOC);
        return $SeGuardo;
        $this->Conexion->CerrarConexion();
    }
    function RegistrarVenta($asesor_id, $estado_venta_id, $estado_backoffice_id, $cliente_id, $venta_detalles_id)
    {

        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("insert INTO ventas(asesor_id, estado_venta_id, estado_backoffice_id, cliente_id , venta_detalles_id) VALUES ( ?, ?, ?,?,?)");
        $cadenasql->bindParam(1, $asesor_id, PDO::PARAM_INT);
        $cadenasql->bindParam(2, $estado_venta_id, PDO::PARAM_INT);
        $cadenasql->bindParam(3, $estado_backoffice_id, PDO::PARAM_INT);
        $cadenasql->bindParam(4, $cliente_id, PDO::PARAM_INT);
        $cadenasql->bindParam(5, $venta_detalles_id, PDO::PARAM_INT);
        $SeGuardo = $cadenasql->execute();
        $resultado = $cadenasql->fetch(PDO::FETCH_ASSOC);
        return $SeGuardo;
        $this->Conexion->CerrarConexion();
    }
    function ObtenerUltimoClienteId()
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("select MAX(cliente_id) AS ultimo_id FROM cliente");
        $cadenasql->execute();
        $resultado = $cadenasql->fetch(PDO::FETCH_ASSOC);
        $ultimoId = $resultado['ultimo_id'];
        $this->Conexion->CerrarConexion();

        return $ultimoId;
    }

    function ObtenerUltimoVentaDetalleId()
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("SELECT MAX(venta_detalle_id) AS ultimo_id FROM venta_detalles");
        $cadenasql->execute();
        $resultado = $cadenasql->fetch(PDO::FETCH_ASSOC);
        $ultimoId = $resultado['ultimo_id'];
        $this->Conexion->CerrarConexion();

        return $ultimoId;
    }
}
