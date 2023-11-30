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
        $this->Conexion->CerrarConexion();
        return $SeGuardo;
    }
    function RegistrarVentaDetalles($tipo_de_plan, $nivel_1, $nivel_2, $nivel_3, $nsn, $activacion_inmediata, $observaciones, $fecha)
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("INSERT INTO venta_detalles (tipo_de_plan, nivel_1, nivel_2, nivel_3, nsn, activacion_inmediata, observaciones, fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $cadenasql->bindParam(1, $tipo_de_plan, PDO::PARAM_STR);
        $cadenasql->bindParam(2, $nivel_1, PDO::PARAM_STR);
        $cadenasql->bindParam(3, $nivel_2, PDO::PARAM_STR);
        $cadenasql->bindParam(4, $nivel_3, PDO::PARAM_STR);
        $cadenasql->bindParam(5, $nsn, PDO::PARAM_STR);
        $cadenasql->bindParam(6, $activacion_inmediata, PDO::PARAM_BOOL);
        $cadenasql->bindParam(7, $observaciones, PDO::PARAM_STR);
        $cadenasql->bindParam(8, $fecha, PDO::PARAM_STR);

        $SeGuardo = $cadenasql->execute();
        $this->Conexion->CerrarConexion();

        return $SeGuardo;
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
        $this->Conexion->CerrarConexion();
        return $SeGuardo;
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


    function ObternerRegistroVentas()
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("CALL GetSalesDetails()");
        $cadenasql->execute();
        $result = $cadenasql->fetchAll(PDO::FETCH_ASSOC);
        $this->Conexion->CerrarConexion();

        return $result;
    }


    function ObtenerFullRegistroVentas($ventaId)
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("CALL GetFullSalesByVentaId(:ventaId)");
        $cadenasql->bindParam(':ventaId', $ventaId, PDO::PARAM_INT);
        $cadenasql->execute();
        $result = $cadenasql->fetch(PDO::FETCH_ASSOC);
        $this->Conexion->CerrarConexion();

        return $result;
    }


    function obtenerRegistroVentabyfecha($fecha_begin, $fecha_end)
    {
        $ConexionEstablecida = $this->Conexion->Conexion();
        $cadenasql = $ConexionEstablecida->prepare("CALL ObtenerRegistroVentabyFecha(:fecha_begin, :fecha_end)");
        $cadenasql->bindParam(':fecha_begin', $fecha_begin, PDO::PARAM_STR);
        $cadenasql->bindParam(':fecha_end', $fecha_end, PDO::PARAM_STR);
        $cadenasql->execute();
        $result = $cadenasql->fetchAll(PDO::FETCH_ASSOC);
        $this->Conexion->CerrarConexion();

        return $result;
    }


    function updateVentaDetalleSeguimientoVenta(

        $venta_id,
        $planBase,
        $ciclo,
        $planAMigrar,
        $departamento,
        $tipoDeFc,
        $TipoDeVenta,
        $EstadoDeVenta
    ) {
        $ConexionEstablecida = $this->Conexion->Conexion();

        $cadenasql = $ConexionEstablecida->prepare("CALL UpdateVentaDetalleSeguimientoVenta(:venta_id, :planBase, :ciclo, :planAMigrar, :departamento, :tipoDeFc, :TipoDeVenta , :EstadoDeVenta)");

        $cadenasql->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $cadenasql->bindParam(':planBase', $planBase, PDO::PARAM_STR);
        $cadenasql->bindParam(':ciclo', $ciclo, PDO::PARAM_STR);
        $cadenasql->bindParam(':planAMigrar', $planAMigrar, PDO::PARAM_STR);
        $cadenasql->bindParam(':departamento', $departamento, PDO::PARAM_STR);
        $cadenasql->bindParam(':tipoDeFc', $tipoDeFc, PDO::PARAM_STR);
        $cadenasql->bindParam(':TipoDeVenta', $TipoDeVenta, PDO::PARAM_STR);
        $cadenasql->bindParam(':EstadoDeVenta', $EstadoDeVenta, PDO::PARAM_INT);
        $cadenasql->execute();

        $this->Conexion->CerrarConexion();
    }
}
