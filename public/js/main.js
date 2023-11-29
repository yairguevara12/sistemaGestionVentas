$('#nivel1').change(function () {
    if ($(this).val() === 'Contacto_Efectivo') {
        clean("nivel2");
        clean("nivel3");
        addoption("nivel2", "venta", "venta");
        addoption("nivel2", "agendado", "agendado");


    } else if ($(this).val() === 'Contacto_No_Efectivo') {
        clean("nivel2");
        clean("nivel3");
        addoption("nivel2", "No_Venta", "No Venta");
        addoption("nivel2", "No_Llamar", "No Llamar");
        addoption("nivel2", "Llamada_Vicio", "Llamada Vicio");

    }
});

$('#nivel2').change(function () {
    if ($(this).val() === 'venta') {
        clean("nivel3");
        addoption("nivel3", "Acepta_Upgrade", "Acepta Upgrade");

    } else if ($(this).val() === 'agendado') {
        clean("nivel3");
        addoption("nivel3", "Renovacion_De_Equipo", "Renovacion de equipo");
        addoption("nivel3", "Acepta_Upgrade_Y_Renovacion_De_Equipo", "Acepta Upgrade Y Renovacion De Equipo");
        addoption("nivel3", "Cliente_Interesado", "Cliente Interesado");

    } else if ($(this).val() === 'No_Venta') {
        clean("nivel3");
        addoption("nivel3", "Corta_Llamada", "Corta Llamada");
        addoption("nivel3", "Plan_muy_caro", "Plan muy caro");
        addoption("nivel3", "Buzon", "buzon");

    } else if ($(this).val() === 'No_Llamar') {
        clean("nivel3");
        addoption("nivel3", "CLiente_no_desea_recibir_llamadas", "CLiente no desea recibir llamadas");


    } else if ($(this).val() === 'Llamada_Vicio') {
        clean("nivel3");
        addoption("nivel3", "Llamada vacia", "Llamada vacia");


    }
});



$('#nivel2').change(function () {
    if ($(this).val() === 'venta') {
        clean("nivel3");
        addoption("nivel3", "Acepta_Upgrade", "Acepta Upgrade");

    } else if ($(this).val() === 'agendado') {
        clean("nivel3");
        addoption("nivel3", "Renovacion_De_Equipo", "Renovacion de equipo");
        addoption("nivel3", "Acepta_Upgrade_Y_Renovacion_De_Equipo", "Acepta Upgrade Y Renovacion De Equipo");
        addoption("nivel3", "Cliente_Interesado", "Cliente Interesado");

    } else if ($(this).val() === 'No_Venta') {
        clean("nivel3");
        addoption("nivel3", "Corta_Llamada", "Corta Llamada");
        addoption("nivel3", "Plan_muy_caro", "Plan muy caro");
        addoption("nivel3", "Buzon", "buzon");

    } else if ($(this).val() === 'No_Llamar') {
        clean("nivel3");
        addoption("nivel3", "CLiente_no_desea_recibir_llamadas", "CLiente no desea recibir llamadas");


    } else if ($(this).val() === 'Llamada_Vicio') {
        clean("nivel3");
        addoption("nivel3", "Llamada vacia", "Llamada vacia");


    }
});
$('#tipoDocumento').change(function () {
    if ($(this).val() === 'DNI') {
        ocultarElemento("activacionInmediata");
        ocultarElemento("labelactivacionInmediata")
        MostrarElemento("nrosn");
        MostrarElemento("labelnrosn");
    } else if ($(this).val() === 'C.E') {
        ocultarElemento("nrosn");
        ocultarElemento("labelnrosn");
        MostrarElemento("activacionInmediata");
        MostrarElemento("labelactivacionInmediata");

    } else if ($(this).val() === 'RUC') {
        ocultarElemento("nrosn");
        ocultarElemento("activacionInmediata");
        ocultarElemento("labelactivacionInmediata")
        ocultarElemento("labelnrosn");


    } else if ($(this).val() === 'PASAPORTE') {
        ocultarElemento("nrosn");
        ocultarElemento("activacionInmediata");
        ocultarElemento("labelactivacionInmediata")
        ocultarElemento("labelnrosn");

    }
});


function ocultarElemento(element) {
    $("#" + element).hide();
}
function MostrarElemento(element) {

    $("#" + element).show();

}

function clean(div) {
    $('#' + div)
        .find('option')
        .remove()
        .end()
        .append('<option value="null" >[Selecciona]</option>')
        .val('null');
}

function addoption(tipo, value, text) {
    $('#' + tipo).append($('<option>', {
        value: value,
        text: text
    }));
}
/**/

function registrarVenta() {
    var url = "http://localhost/SistemaGestionVentas/controllers/AjaxMainRegistro.php";

    // Get values from form elements
    var telefono = $("#telefono").val();
    var tipoDocumento = $("#tipoDocumento").val();
    var nroDocumento = $("#nroDocumento").val();
    var nombres = $("#nombres").val();
    var apellidos = $("#apellidos").val();
    var tipoPlan = $("#tipoPlan").val();
    var nivel1 = $("#nivel1").val();
    var nivel2 = $("#nivel2").val();
    var nivel3 = $("#nivel3").val();
    var nrosn = $("#nrosn").val();
    var activacionInmediata = $("#activacionInmediata").val();
    var observaciones = $("#observaciones").val();
    var idUsuario = $("#idUsuario").val();
    // Create data object to send in the Ajax request
    var formData = {
        "telefono": telefono,
        "tipoDocumento": tipoDocumento,
        "nroDocumento": nroDocumento,
        "nombres": nombres,
        "apellidos": apellidos,
        "tipoPlan": tipoPlan,
        "nivel1": nivel1,
        "nivel2": nivel2,
        "nivel3": nivel3,
        "nrosn": nrosn,
        "activacionInmediata": activacionInmediata,
        "observaciones": observaciones,
        "idUsuario": idUsuario
    };
    console.log(formData);
    $.ajax({
        data: formData,
        url: url,
        type: 'post',
        success: function (response) {
            var result = $.parseJSON(response);
        }
    });
}
