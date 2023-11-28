<?php

require_once("controllers/errores.php");

class Ruteador
{

    function __construct()
    {
        $this->startRouter();
    }

    function startRouter()
    {

        session_start();

        $ArregloUrl = $this->SeguridadUsuario();

        $controllerName = $ArregloUrl[0];


        $fileName = "controllers/" . $controllerName . ".php";
        $this->ObtenerArchivos($fileName, $ArregloUrl);
    }

    function SeguridadUsuario()
    {
        if (!isset($_SESSION["PermitirIngreso"])) {

            $_SESSION["PermitirIngreso"] =  false;
        }

        $ArregloUrl   = $this->getArregloUrl();

        ///logeados
        if ($_SESSION["PermitirIngreso"]) {
            $isLogin = $ArregloUrl[0];
            if ($isLogin == "login") {
                $ArregloUrl = ["main"];
            } else {
                $ArregloUrl   = $this->getArregloUrl();
            }

            ///sin logearse    
        } else {
            $esMetodo = "";
            $esRegistrar = "";
            ///validar
            if (isset($ArregloUrl[1])) {
                $esMetodo =  $ArregloUrl[1];
            }
            if (isset($ArregloUrl[0])) {
                $esRegistrar = $ArregloUrl[0];
            }

            ///controladores a los que se puede acceder
            if ($esMetodo == "ValidarIngreso") {

                $ArregloUrl = ["login", "ValidarIngreso"];
            } else if ($esMetodo == "IngresarUsuario") {
                $ArregloUrl = ["registrar", "ingresarusuario"];
            } else if ($esRegistrar == "registrar") {
                $ArregloUrl = ["Registrar"];
            } else {
                $ArregloUrl = ["login"];
            }
        }
        return $ArregloUrl;
    }

    function getArregloUrl()
    {

        if (isset($_GET["url"])) {
            $urlBrowser = $_GET["url"];
        }

        $fullUrl = "";

        if (isset($urlBrowser)) {

            $fullUrl = $urlBrowser;
        } else {
            $fullUrl = "main";
        }

        $removedLastSlash = rtrim($fullUrl, "/");
        //Subdividir la URL		
        $ArregloUrl = explode("/", $removedLastSlash);

        return $ArregloUrl;
    }

    function ObtenerArchivos($fileName, $ArregloUrl)
    {
        if (file_exists($fileName)) {
            //Incluir el archivo del controlador
            require_once($fileName);
            //Instanciar el CONTROLADOR

            $controllerFromUrl = "";
            if (isset($ArregloUrl[0])) {
                $controllerFromUrl = $ArregloUrl[0];
            }

            $methodFromUrl = "";
            if (isset($ArregloUrl[1])) {
                $methodFromUrl = $ArregloUrl[1];
            }

            $objTipoController = new $controllerFromUrl;
            $methodController = $methodFromUrl;

            $this->EjecutarMetodos($objTipoController, $methodController);
        } else {
            $objTipoController = new Errores();
            $objTipoController->mostrarVista();
        }
    }

    function EjecutarMetodos($objTipoController, $methodController)
    {

        if (isset($methodController) && !empty($methodController)) {
            //Ejecutar el metodo
            //obj->metodo()
            if (method_exists($objTipoController, $methodController)) {
                $objTipoController->{$methodController}();
            } else {

                $objTipoController = new Errores();
                $objTipoController->mostrarVista();
            }
            //Colocar la variable entre llaves
            //para considerar el valor como variable
        } else {

            $objTipoController->mostrarVista();
        }
        //Mostrar VISTA del CONTROLADOR
    }
}
