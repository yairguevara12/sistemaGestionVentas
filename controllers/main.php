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
    function cerrarsesion()
    {




        unset($_SESSION['PermitirIngreso']);
        unset($_SESSION['usuarioName']);
        unset($_SESSION['idUsuario']);
        unset($_SESSION['idPerfilUsuario']);
        unset($_SESSION['usuarioDB']);
        session_unset();
        session_destroy();
        header("Location:" .  constant('URL'));
    }
}
