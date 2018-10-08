<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#00A89E" />
    <link rel="manifest" href="/SocialHealth/manifest.json" />

    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="/SocialHealth/template/css/mystyle.css"> -->
    <!-- <link rel="stylesheet" href="/SocialHealth/template/css/estilos.css"> -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.css"/> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.js"></script> -->
    <title>Social Health</title>

    <style>
      .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 10;
      background: url('/SocialHealth/loading1.gif') 50% 50% no-repeat rgb(255, 255, 255);
      opacity: .8;}
    </style>
    <script type="text/javascript">
      $(window).ready(function() {
        $(".loader").fadeOut("slow");});
    </script>

  </head>
  <body>
  <div class="loader"></div>
    
      <div class="header">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-dark nv-color">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-toggler dropdown" style="border: 0px;" data-toggle="collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <a class="nav-link dropdown-toggle profile-span" href="#" id="nvdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <h6><?php echo utf8_decode($row['nombre'])," ",utf8_decode($row['apellido']); ?></h6>    <img src="<?php echo $ruta ?>" class="profile-pic"  alt=""> 
                </a>
                <div class="dropdown-menu" aria-labelledby="nvdd">
                  <a class="dropdown-item" href="#">Mi Perfil</a>
                  <a class="dropdown-item" href="#">Ajustes</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Cerrar Sesion</a>
                </div>
          </div>
          <a class="navbar-brand d-none d-block-xl d-block-lg d-block-md" href="#">Navbar</a>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#"><img style="width: 100px;" src="/SocialHealth/assets/images/logo-100px.png" alt=""><span class="sr-only">(current)</span></a>
              </li>
              <div class="d-block d-xl-none d-lg-none d-md-none">
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
              </div>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <div class="nav-link dropdown-toggle profile-span" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <h6><b><?php echo utf8_decode($row['nombre'])," ",utf8_decode($row['apellido']); ?></h6></b>    <img src="<?php echo $ruta ?>" class="profile-pic"  alt="">
                  </div>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Mi Perfil</a>
                    <a class="dropdown-item" href="#">Ajustes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
            </form>
          </div>
        </nav>
      </div>
      <div class="container-fluid">
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

          
          <div id="contenedor" class="col-11 col-xl-11 col-lg-11 col-md-11 col-sm-12 col-xs-12" style="  margin-left: auto;
          margin-right: auto;">
          <br><br><br>
          