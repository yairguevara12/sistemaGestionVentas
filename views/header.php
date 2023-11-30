<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SistemaGestionVentas</title>
  <!--boostrap-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!--boostrap-->
  <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

  <!--    Datatables  -->
  <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" /> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />


  <!--    Datatables  -->

  <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <!-------------------- OWN-MADE  CSS -------------------->
  <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/styles.css">
  <!-------------------- OWN-MADE  CSS -------------------->

  <!------------------------fecha------------------------>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!--fecha-->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>

  <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
  <!------------------------fecha------------------------>

  <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

  <!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


  <!-----------------------------------------------------------------------JS FILES------------------------------------------------------------------------------------------------------------>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SYS VENTAS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <?php

        if (isset($_SESSION['idUsuario'])) { ?>

          <div class="d-flex justify-content-between">
            <div>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="<?php echo constant('URL') ?>main">Registrar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="" href="<?php echo constant('URL') ?>registroVentas">Registro Ventas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="" href="<?php echo constant('URL') ?>registroVentas">Pendiente Upgrade</a>
                </li>
            </div>
            <div>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link link-btn text-success fw-bold" href="#" id="perfilUsuario"><?php if (isset($_SESSION["idPerfilUsuario"])) {
                                                                                                  if ($_SESSION["idPerfilUsuario"] == "1") {
                                                                                                    echo "asesor";
                                                                                                  } else   if ($_SESSION["idPerfilUsuario"] == "2") {
                                                                                                    echo "supervisor";
                                                                                                  } else   if ($_SESSION["idPerfilUsuario"] == "3") {
                                                                                                    echo "backoffice";
                                                                                                  }
                                                                                                }   ?></a>

                </li>
                <li class="nav-item">
                  <a class="nav-link link-danger btn fw-bold" href="<?php echo constant('URL') ?>main/cerrarsesion">SALIR</a>
                </li>
              </ul>
            </div>
          </div>



        <?php } ?>
      </div>
    </div>
  </nav>
</body>