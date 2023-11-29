$(document).ready(function () {
    obternerRegistroVentas();
});


const PerfilUsuario = $("#perfilUsuario").text();

function loadDataRegistroVentas(registroVentaData) {
    console.log(PerfilUsuario);
    let columns = [{}];
    if (PerfilUsuario == "supervisor") {
        columns = [{
            title: "COD VENTA",
            data: "venta_id"
        },
        {
            title: "FECHA",
            data: "fecha"
        },
        {
            title: "CLIENTE",
            data: "nombres"
        },
        {
            title: "DOCUMENTO",
            data: "nro_de_documento"
        },
        {
            title: "ESTADO VENTA",
            data: "estado_venta_nombre"
        },
        {
            title: "DETALLE",
            data: "detalles"
        }, {
            title: "EDITAR",
            data: "editar"
        }
        ]
    } else {
        columns = [{
            title: "COD VENTA",
            data: "venta_id"
        },
        {
            title: "FECHA",
            data: "fecha"
        },
        {
            title: "CLIENTE",
            data: "nombres"
        },
        {
            title: "DOCUMENTO",
            data: "nro_de_documento"
        },
        {
            title: "ESTADO VENTA",
            data: "estado_venta_nombre"
        },
        {
            title: "DETALLE",
            data: "detalles"
        },
        ]
    }

    $('#tableRegistroVentas').dataTable({

        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        },
        "select": true,
        /*    "search": {
               "search": ""
           } */
        responsive: "true",
        data: registroVentaData,
        "columns": columns

    });
}



function obternerRegistroVentas() {
    var url = "http://localhost/SistemaGestionVentas/controllers/AjaxObtenerRegistroVentas.php";


    var formData = {
    };

    $.ajax({
        data: formData,
        url: url,
        type: 'post',
        success: function (response) {
            var result = $.parseJSON(response);
            let newResult = result.map((row) => {
                /* console.log(row); */
                let newRow = {};
                if (PerfilUsuario == "supervisor") {
                    newRow = {
                        estado_venta_nombre: row.estado_venta_nombre,
                        fecha: row.fecha == null ? "-" : row.fecha,
                        nombres: row.nombres,
                        nro_de_documento: row.nro_de_documento,
                        venta_id: row.venta_id,
                        detalles: `
                    <button type="button" onClick="ObtenerRegistroVentaById(${row.venta_id})" class="btn btn-info" data-toggle="modal" data-target="#detallesventas">
                    Detalles
                    </button>
                    `,
                        editar: `
                    <button type="button" onClick="mostrarFormularioSeguimientoVenta(${row.venta_id})" class="btn btn-warning" data-toggle="modal" data-target="#detallesventas">
                    Editar
                    </button>
                    `

                    }
                } else {
                    newRow = {
                        estado_venta_nombre: row.estado_venta_nombre,
                        fecha: row.fecha == null ? "-" : row.fecha,
                        nombres: row.nombres,
                        nro_de_documento: row.nro_de_documento,
                        venta_id: row.venta_id,
                        detalles: `
                    <button type="button" onClick="ObtenerRegistroVentaById(${row.venta_id})" class="btn btn-info" data-toggle="modal" data-target="#detallesventas">
                    Detalles
                    </button>
                    
                    `

                    }
                }

                return newRow;
            })
            console.log(newResult);
            loadDataRegistroVentas(newResult);
        }
    });
}

function ObtenerRegistroVentaById(idventa) {
    var url = "http://localhost/SistemaGestionVentas/controllers/AjaxObtenerFullRegistroVentas.php";


    var formData = {
        "idventa": idventa,

    };

    $.ajax({
        data: formData,
        url: url,
        type: 'post',
        success: function (response) {
            var result = $.parseJSON(response);
            rellenarVentaDetallesFormulario(result);
            console.log(result);

        }
    });
}




function obtenerRegistrobyfecha(fechainicio, fechafinal) {
    var url = "http://localhost/SistemaGestionVentas/controllers/AjaxObtenerRegistroVentasbyFecha.php";


    var formData = {
        "fechainicio": fechainicio,
        "fechafinal": fechafinal

    };

    $.ajax({
        data: formData,
        url: url,
        type: 'post',
        success: function (response) {
            var result = $.parseJSON(response);
            let newResult = result.map((row) => {
                /* console.log(row); */
                let newRow = {
                    estado_venta_nombre: row.estado_venta_nombre,
                    fecha: row.fecha == null ? "-" : row.fecha,
                    nombres: row.nombres,
                    nro_de_documento: row.nro_de_documento,
                    venta_id: row.venta_id,
                    detalles: `
                    <button type="button" onClick="ObtenerRegistroVentaById(${row.venta_id})" class="btn btn-info" data-toggle="modal" data-target="#detallesventas">
                    Detalles
                    </button>
                    `,
                    editar: `
                    <button type="button" onClick="mostrarFormularioSeguimientoVenta(${row.venta_id})" class="btn btn-warning" data-toggle="modal" data-target="#detallesventas">
                    Editar
                    </button>
                    `

                }
                return newRow;
            })
            console.log(newResult);
            loadDataRegistroVentas(newResult);
        }
    });
}


function mostrarRegistrosbyFecha() {
    let fechainicio = $("#fechainicio").val();
    let fechafinal = $("#fechafinal").val();
    cleanTabla();
    obtenerRegistrobyfecha(fechainicio, fechafinal);
}

function cleanTabla() {
    var table = $('#tableRegistroVentas').DataTable();
    table.destroy();

}

function mostrarFormularioSeguimientoVenta(idventa) {
    $('#seguimientoVentasDetalle').modal('show');
    console.log(idventa);
    $("#id_venta_seguimiento").text(idventa);
}



function actualizarValoresSeguimientoVenta() {
    var url = "http://localhost/SistemaGestionVentas/controllers/AjaxUpdateVentaDetalleSeguimientoVenta.php";

    // Get values from form elements
    var idventa = $("#id_venta_seguimiento").text();
    var planBase = $("#plan_base").val();
    var ciclo = $("#ciclo").val();
    var planAMigrar = $("#plan_a_migrar").val();
    var departamento = $("#departamento").val();
    var tipoDeFc = $("#tipo_de_fc").val();
    var tipoDeVenta = $("#tipo_de_venta").val();
    var estadoDeVenta = $("#estado_de_venta").val();
    // Create data object to send in the Ajax request
    var formData = {
        "venta_id": idventa,
        "planBase": planBase,
        "ciclo": ciclo,
        "planAMigrar": planAMigrar,
        "departamento": departamento,
        "tipoDeFc": tipoDeFc,
        "tipoDeVenta": tipoDeVenta,
        "estadoDeVenta": estadoDeVenta

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

    $('#seguimientoVentasDetalle').modal('hide');
    location.reload();


}

function rellenarVentaDetallesFormulario(formData) {

    $("#telefono").val(formData.telefono);
    $("#tipoDocumento").val(formData.tipo_de_documento);
    $("#nroDocumento").val(formData.nro_de_documento);
    $("#nombres").val(formData.nombres);
    $("#apellidos").val(formData.apellidos);
    $("#tipoPlan").val(formData.tipo_de_plan);
    $("#nivel1").val(formData.nivel_1);
    $("#nivel2").val(formData.nivel_2);
    $("#nivel3").val(formData.nivel_3);
    $("#nrosn").val(formData.nsn);
    $("#activacionInmediata").val(formData.activacion_inmediata);
    $("#observaciones").val(formData.observaciones);

    $('#detallesventas').modal('show');
}
