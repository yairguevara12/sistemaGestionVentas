<?php
require_once("views/header.php");

?>
<div class="container mb-5 mt-5">
    <div class="container">
        <h3>Seguimiento de Ventas</h3>
    </div>
    <div class="d-flex container justify-content-around">
        <div class="d-flex flex-sm-row">
            <h5 class=" mx-5">Inicio:</h5>
            <input type="date" id="fechainicio" alt="inicio" />
        </div>
        <div class="d-flex flex-sm-row ">
            <h5 class="mx-5">Fin:</h5>
            <input type="date" id="fechafinal" alt="fin" />
        </div>
        <div class="d-flex flex-sm-row ">
            <button class="mx-5" onclick="mostrarRegistrosbyFecha()">Buscar</button>

        </div>
    </div>
</div>
<div class="container">
    <table class="table container " id="tableRegistroVentas">

    </table>
</div>

<!--modal-->

<?php
echo $_SESSION["idPerfilUsuario"];
?>


<!-- The Modal -->
<div class="modal fade" id="detallesventas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">DETALLE DE VENTA</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="container mb-5 formVenta p-4 mt-5" id="registroVenta" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="text-uppercase">TELÉFONO:</label>
                                <input type="tel" class="form-control" id="telefono">
                            </div>

                            <div class="form-group">
                                <label for="tipoDocumento" class="text-uppercase">TIPO DE DOCUMENTO:</label>
                                <input type="text" class="form-control" id="tipoDocumento" />

                            </div>

                            <div class="form-group">
                                <label for="nombres" class="text-uppercase">NOMBRES:</label>
                                <input type="text" class="form-control" id="nombres">
                            </div>

                            <div class="form-group">
                                <label for="nivel1" class="text-uppercase">NIVEL 1:</label>
                                <input class="form-control" id="nivel1" />

                            </div>

                            <div class="form-group">
                                <label for="nivel3" class="text-uppercase">NIVEL 3:</label>
                                <input class="form-control" id="nivel3" />

                            </div>

                            <div class="form-group">
                                <label for="nrosn" class="text-uppercase">N° SN:</label>
                                <input class="form-control" id="nrosn" />

                            </div>


                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="tipoPlan" class="text-uppercase">TIPO DE PLAN:</label>
                                <input class="form-control" id="tipoPlan" />



                            </div>

                            <div class="form-group">
                                <label for="nroDocumento" class="text-uppercase">NRO DE DOCUMENTO:</label>
                                <input type="text" class="form-control" id="nroDocumento" placeholder="Ingresa tu número de documento">
                            </div>

                            <div class="form-group">
                                <label for="apellidos" class="text-uppercase">APELLIDOS:</label>
                                <input type="text" class="form-control" id="apellidos" placeholder="Ingresa tus apellidos">
                            </div>


                            <div class="form-group">
                                <label for="nivel2" class="text-uppercase">NIVEL 2:</label>
                                <input class="form-control" id="nivel2" />

                            </div>

                            <div class="form-group">
                                <label for="activacionInmediata" class="text-uppercase">ACTIVACIÓN INMEDITA:</label>
                                <input class="form-control" id="activacionInmediata" />

                            </div>

                            <div class="form-group">
                                <label for="observaciones" class="text-uppercase">OBSERVACIONES:</label>
                                <textarea class="form-control" id="observaciones" rows="3"></textarea>
                            </div>

                        </div>
                    </div>


                </form>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>









<div class="modal fade" id="seguimientoVentasDetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">SEGUIMIENTO DE VENTA DETALLE</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="container mb-5 formVenta p-4 mt-5" id="registroVenta" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="plan_base" class="text-uppercase">PLAN BASE:</label>
                                <input type="text" class="form-control" id="plan_base">
                            </div>

                            <div class="form-group">
                                <label for="ciclo" class="text-uppercase">CICLO:</label>
                                <input type="text" class="form-control" id="ciclo" />

                            </div>

                            <div class="form-group">
                                <label for="plan_a_migrar" class="text-uppercase">PLAN A MIGRAR:</label>
                                <input type="text" class="form-control" id="plan_a_migrar">
                            </div>

                            <div class="form-group">
                                <label for="departamento" class="text-uppercase">DEPARTAMENTO</label>
                                <input type="text" class="form-control" id="departamento" />

                            </div>

                            <div class="form-group">
                                <label for="tipo_de_fc" class="text-uppercase">TIPO DE FC</label>
                                <input type="text" class="form-control" id="tipo_de_fc" />

                            </div>

                            <div class="form-group">
                                <label for="tipo_de_venta" class="text-uppercase">TIPO DE VENTA:</label>
                                <input type="text" class="form-control" id="tipo_de_venta" />

                            </div>


                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="estado_de_venta" class="text-uppercase">ESTADO DE VENTA:</label>
                                <select class="form-control" id="estado_de_venta">
                                    <option value="seleccione">[seleccione]</option>
                                    <option value="1">Pentiente</option>
                                    <option value="2">Aprobada</option>
                                    <option value="3">Rechazada</option>
                                </select>



                            </div>


                            <div class="form-group" hidden>
                                <input type="text" class="form-control" id="id_venta_seguimiento" value="" hidden />

                            </div>

                        </div>
                    </div>


                </form>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="actualizarValoresSeguimientoVenta()">Guardar Cambios</button>
            </div>

        </div>
    </div>
</div>




<script src="<?php echo constant('URL') ?>public/js/registroVenta.js"></script>
<?php
require_once("views/footer.php");

?>