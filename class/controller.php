<?php

class Controller
{

    function __construct()
    {
    }

    function cargarModelo($nombre)
    {

        //Generar el nombre del archivo
        $fileName = "models/" . $nombre . ".php";

        //inlcuir el archivo
        require_once($fileName);

        //Instanciar el modelo
        $modelo = new $nombre();

        //Retornar el MODELO
        return $modelo;
    }
}
?>