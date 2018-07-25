<!doctype html>
<html lang="en">
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
          <nav class="navbar navbar-expand navbar-light" style="background-color: #00A89E;">
            <a class="navbar-brand" href="#"><img style="width: 100px;" src="../Menu/images/logo.png" alt=""></a>
            <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button-->
            <div class="col">
              <ul class="navbar-nav dropdown-menu-right" style="float:right;">
                <li class="nav-item dropdown" >
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h6 style="display:inline;"><?php echo utf8_decode($row['nombre'])," ",utf8_decode($row['apellido']); ?>       </h6><img src="<?php echo $ruta ?>" class="profile-pic"  alt=""> 
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Mi Cuenta</a><!-- Aqui pon -->
                    <a class="dropdown-item" href="#">Ajustes</a>
                    <a class="dropdown-item" href="../login/logout.php">Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
            </div>
            <!--div class="collapse navbar-collapse" id="navbarNavDropdown">
            </div-->
          </nav>
        </header>
        <input type="checkbox" id="check">
        <label for="check" class=""></label> 
        <div class="row">
          <div class="col-1 col-xs-3">
          </div>

          <?php
          if($tipo==1){
            include 'menupac.html';
          }elseif($tipo==2){
            include 'menupro.html';
          }
          ?>
          
          <div class="col-11 col-xs-9">
          <br><br><br>