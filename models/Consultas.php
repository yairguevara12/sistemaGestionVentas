<?php
require_once("bd/Conexion.php");
class Consultas
{

    private $Conexion = "";

    function __construct()
    {

        $this->Conexion = new Conexion();
    }

    function validarUsuario($email, $password)
    {
        $ConexionEstablecida = $this->Conexion->Conexion();

        $cadenasql = "select * from usuarios where email= '" . $email    . "'and clave= '" . $password . "';";
        $registros = $ConexionEstablecida->query($cadenasql);
        $resultado = $registros->fetch();

        if (empty($resultado)) {
            $resultado = [0];
        }


        $this->Conexion->CerrarConexion();
        return $resultado;
    }
}
