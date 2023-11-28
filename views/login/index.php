<?php
require_once("views/header.php");

?>

<div class="container-imagen-login">
    <div class="container-imagen">
        <img alt="sistema ventas" src="<?php echo constant('URL') ?>public/assets/loginImagen.jpg" />
    </div>
    <div class="container-login">
        <form action="<?php echo constant('URL') ?>login/ValidarIngreso" name="loginFormulario" method="post" onsubmit="return validarFormulario()">

            <div>
                <h1>LOGIN</h1>
            </div>
            <div>
                <h6>Inicia sesion con tus datos</h6>
            </div>
            <div class="div-email-result" style=" text-align : right">
                <p id="result"></p>
            </div>


            <div class="Error-iniciar-session">
                <div><i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div>EL USUARIO O CONTRASEÑO ES INCORRECTO</div>
            </div>
            <div class="Error-iniciar-session-campos">
                <div><i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div>LLENE TODO LOS CAMPOS</div>
            </div>


            <div>
                <h5>Email</h5> <input class="login-text-input" id="email" name="email" type="text" placeholder="Tu email" />
            </div>
            <div>
                <h5>Password</h5> <input class="login-text-input" type="password" name="pass" placeholder="Tu password" />
            </div>
            <div>
                <input type="submit" class="login-submit-input" value="Iniciar Sesion" />
            </div>
            <div>
                <p><a href="<?php echo constant('URL') ?>registrar">¿Aun no tienes una cuenta? Crea Una</a></p>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo constant('URL') ?>public/js/login.js"></script>
<?php
require_once("views/footer.php");

?>