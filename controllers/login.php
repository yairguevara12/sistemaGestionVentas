<?php
class login
{

    function __construct()
    {

        //Invocar al metodo MostrarVista

    }

    function mostrarVista()
    {
        $nombre = "login/index";
        //Codigo para mostrar la Vista
        //Generar el nombre de la vista: views/consulta/index.php
        $fileName = "views/" . $nombre . ".php";




        require_once("$fileName");
    }


    function ValidarIngreso()
    {

        require_once("Encriptador.php");
        require_once("models/Consultas.php");
        $Consultas = new Consultas();

        $encriptador = new Encriptador();



        if ((isset($_POST["email"])) && (isset($_POST["pass"]))) {
            $email = $_POST["email"];
            $passwCodificada = $encriptador->Encriptar($_POST["pass"]);

            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $passwCodificada;


            $ArregloCredenciales = $Consultas->validarUsuario($email, $passwCodificada);




            $idUsuario = "";
            $idPerfilUsuario = "";
            $usuarioName = "";
            $usuarioDB = "";
            if ($ArregloCredenciales[0]) {
                $idUsuario = $ArregloCredenciales[0];
                $idPerfilUsuario = $ArregloCredenciales[1];
                $usuarioName = $ArregloCredenciales[2];
                $usuarioDB = $ArregloCredenciales[4];
            }

            if ($idUsuario > 0) {
                $_SESSION["PermitirIngreso"] = true;
                $_SESSION["usuarioName"] = $usuarioName;
                $_SESSION["idUsuario"] = $idUsuario;
                $_SESSION["idPerfilUsuario"] = $idPerfilUsuario;
                $_SESSION["usuarioDB"] = $usuarioDB;
                header("Location:" .  constant('URL')  . "main");
            } else {
                header("Location:" .  constant('URL')  . "login?validacion=1");
            }
        }
    }
}
