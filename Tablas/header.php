<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="icon/css/fontello.css">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.css"/>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.js"></script>
    <title>Social Health</title>

    <style>
      .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 10;
      background: url('../loading1.gif') 50% 50% no-repeat rgb(255, 255, 255);
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