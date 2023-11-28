<?php
class main
{

    function __construct()
    {

        //Invocar al metodo MostrarVista

    }

    function mostrarVista()
    {

        $mainPage = "main/index";

        $fileName = "views/" . $mainPage . ".php";





        require_once("$fileName");
    }
}
