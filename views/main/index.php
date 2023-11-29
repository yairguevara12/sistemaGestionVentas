<?php
require_once("views/header.php");
?>


<div class="container mb-5 p-0 mt-5 ">
  <button type="button" class="btn btn-info">Datos del cliente</button>
</div>

<form class="container mb-5 formVenta p-4 mt-5" id="registroVenta" autocomplete="off">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="telefono" class="text-uppercase">TELÉFONO:</label>
        <input type="tel" class="form-control" id="telefono" placeholder="Ingresa tu número de teléfono">
      </div>

      <div class="form-group">
        <label for="tipoDocumento" class="text-uppercase">TIPO DE DOCUMENTO:</label>
        <select class="form-control" id="tipoDocumento">
          <option value="seleccione">[seleccione]</option>
          <option value="DNI">DNI</option>
          <option value="C.E">C.E</option>
          <option value="RUC">RUC</option>
          <option value="PASAPORTE">Pasaporte</option>
        </select>
      </div>

      <div class="form-group">
        <label for="nombres" class="text-uppercase">NOMBRES:</label>
        <input type="text" class="form-control" id="nombres" placeholder="Ingresa tus nombres">
      </div>

      <div class="form-group">
        <label for="nivel1" class="text-uppercase">NIVEL 1:</label>
        <select class="form-control" id="nivel1">
          <option value="seleccione">[seleccione]</option>
          <option value="Contacto_Efectivo">Contacto Efectivo</option>
          <option value="Contacto_No_Efectivo">Contacto No efectivo</option>

        </select>
      </div>

      <div class="form-group">
        <label for="nivel3" class="text-uppercase">NIVEL 3:</label>
        <select class="form-control" id="nivel3">
          <option value="seleccione">[seleccione]</option>

        </select>
      </div>

      <div class="form-group">
        <label for="nrosn" class="text-uppercase" id="labelnrosn">N° SN:</label>
        <select class="form-control" id="nrosn">
          <option value="seleccione">[seleccione]</option>
          <option value="Si">Si</option>
          <option value="No">No</option>

        </select>
      </div>


    </div>

    <div class="col-md-6">

      <div class="form-group">
        <label for="tipoPlan" class="text-uppercase">TIPO DE PLAN:</label>
        <select class="form-control" id="tipoPlan">
          <option value="seleccione">[seleccione]</option>
          <option value="ILIMITADO">ILIMITADO</option>
          <option value="REGULAR">REGULAR</option>

        </select>


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
        <select class="form-control" id="nivel2">
          <option value="seleccione">[seleccione]</option>

        </select>
      </div>

      <div class="form-group">
        <label for="activacionInmediata" class="text-uppercase" id="labelactivacionInmediata">ACTIVACIÓN INMEDITA:</label>
        <select class="form-control" id="activacionInmediata">
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </div>

      <div class="form-group">
        <label for="observaciones" class="text-uppercase">OBSERVACIONES:</label>
        <textarea class="form-control" id="observaciones" rows="3"></textarea>
      </div>
      <div class="form-group" disabled>
        <input type="text" id="idUsuario" value="<?php echo $_SESSION["idUsuario"]; ?>" hidden />
      </div>
    </div>
  </div>


  <button type="button" onclick="registrarVenta()" class="btn btn-info">Enviar</button>
  <button type="button" class="btn btn-danger">Cancelar</button>
</form>







<script src="<?php echo constant('URL') ?>public/js/main.js">
</script>

<?php
require_once("views/footer.php");

?>