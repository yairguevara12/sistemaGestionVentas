$(document).ready(function () {
    validarCredenciales();
    $(".Error-iniciar-session-campos").hide();
});






function validarCredenciales() {
    const ErrorEncontrado = getParametrosUrl();

    if (ErrorEncontrado) {
        $(".Error-iniciar-session").show();
    } else {
        $(".Error-iniciar-session").hide();
    }

}

function getParametrosUrl() {

    let url_string = window.location.href;
    let url = new URL(url_string);
    let validacion = url.searchParams.get("validacion");

    return validacion != null ? true : false;
}
function validarFormulario() {

    let email = document.forms["loginFormulario"]["email"].value;
    let password = document.forms["loginFormulario"]["pass"].value;


    if (email == "" || password == "") {

        $(".Error-iniciar-session-campos").show();

        return false;
    }

}

const validateEmail = (email) => {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

const validate = () => {
    const $result = $('#result');
    const email = $('#email').val();
    $result.text('');

    if (validateEmail(email)) {
        $result.text(email + ' es un email valido ');
        $result.css('color', 'green');

        $(".login-submit-input").prop('disabled', false);
    } else {
        $result.text(email + ' no es un email valido ');
        $result.css('color', 'red');
        $(".login-submit-input").prop('disabled', true);

    }
    return false;
}
$('#email').on('input', validate);