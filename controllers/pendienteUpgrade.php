<?php
class pendienteUpgrade
{

    function __construct()
    {

        //Invocar al metodo MostrarVista

    }

    function mostrarVista()
    {

        $mainPage = "pendienteUpgrade/index";

        $fileName = "views/" . $mainPage . ".php";





        require_once("$fileName");
    }
}
