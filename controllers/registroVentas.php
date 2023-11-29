<?php
class registroVentas
{

    function __construct()
    {

        //Invocar al metodo MostrarVista

    }

    function mostrarVista()
    {

        $mainPage = "registroVentas/index";

        $fileName = "views/" . $mainPage . ".php";





        require_once("$fileName");
    }
}
