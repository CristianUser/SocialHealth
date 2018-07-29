<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="icon/css/fontello.css">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <title>Social Health</title>

    <style>
      .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 10;
      background: url('../loading1.gif') 50% 50% no-repeat rgb(249,249,249);
      opacity: .8;}
    </style>
    <script type="text/javascript">
      $(window).ready(function() {
        $(".loader").fadeOut("slow");});
    </script>

  </head>
  <body>
  <div class="loader"></div>
    <div class="container-fluid">
        <header>
          <nav class="navbar navbar-expand-xl navbar-expand-lg navbar-expand-md navbar-light" style="background-color: #00A89E;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="navbar-toggler-icon"></span>
              </button>
            <a class="navbar-brand" href="#"><img style="width: 100px;" src="../Menu/images/logo.png" alt=""></a>
            <div class="col">
              <ul class="navbar-nav dropdown-menu-right" style="float:right;">
                <li class="nav-item dropdown" >
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h6 class="d-none d-md-inline d-lg-inline  d-xl-inline" style="display:inline;"><?php echo utf8_decode($row['nombre'])," ",utf8_decode($row['apellido']); ?></h6>    <img src="<?php echo $ruta ?>" class="profile-pic"  alt=""> 
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Mi Cuenta</a>
                    <a class="dropdown-item" href="#">Ajustes</a>
                    <a class="dropdown-item" href="../login/logout.php">Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
            </div>
            <div class="collapse c-menu" id="collapseExample">
                <div class="card card-body">
                    <nav class="">

                        <?php
                        if($tipo==1){
                          include 'menupac.html';
                        }elseif($tipo==2){
                          include 'menupro.html';
                        }
                        ?>
                    </nav>
                </div>
              </div>
          </nav>
        </header>
        <!--input type="checkbox" id="check">
        <label for="check" class=""></label--> 
        <div class="row">
          <div class="col-1 col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs d-none d-md-block d-lg-block  d-xl-block">
          </div>
          <div class="general d-none d-md-block d-lg-block  d-xl-block">
            <nav class="menu">
              <?php
              if($tipo==1){
                include 'menupac.html';
              }elseif($tipo==2){
                include 'menupro.html';
              }
              ?>
            </nav>
          </div>

          
          <div class="col-11 col-xl-11 col-lg-11 col-md-11 col-sm-12 col-xs-12" style="  margin-left: auto;
          margin-right: auto;">
          <br><br><br>