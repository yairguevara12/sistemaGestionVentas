<?php
require_once("ConexionConfiguracion.php");
class Conexion implements ConexionConfiguracion
{
    private $Conexion = "";

    function __construct()
    {
    }



    public function Conexion()
    {

        try {


            $this->Conexion = new PDO(
                "mysql:host=" . ConexionConfiguracion::SERVIDOR . ";" . "dbname=" . ConexionConfiguracion::BD,
                ConexionConfiguracion::USUARIO,
                ConexionConfiguracion::CLAVE
            );
            return $this->Conexion;
        } catch (PDOException $e) {
            echo "ERROR DE CONEXION :" . $e->getMessage();
        }
    }

    public function CerrarConexion()
    {
        $this->Conexion = "";
    }
}
