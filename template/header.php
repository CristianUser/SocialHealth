<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#00A89E" />
    <link rel="manifest" href="/SocialHealth/manifest.json" />
    <title>Social Health</title>
    <!-- <link rel="manifest" href="/SocialHealth/manifest.json" /> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SocialHealth/template/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script type="text/javascript">
      let id=<?php echo $idUsuario;?>;
      let token="<?php echo $token;?>";
      $(window).ready(function() {
        $(".loader").fadeOut("slow");
        getUserTemplate();
      });
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
                 <h6><?php echo utf8_decode($row['nombre'])," ",utf8_decode($row['apellido']); ?></h6>    <img src="" class="profile-pic"  alt=""> 
                </a>
                <div class="dropdown-menu" aria-labelledby="nvdd">
                  <a class="dropdown-item" href="/SocialHealth/components/settings/">Mi Perfil</a>
                  <a class="dropdown-item" href="/SocialHealth/components/settings/">Ajustes</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/SocialHealth/components/login/logout.php">Cerrar Sesion</a>
                </div>
          </div>
          <a class="navbar-brand d-none d-block-xl d-block-lg d-block-md" href="#">Navbar</a>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#"><img style="width: 100px;" src="/SocialHealth/assets/images/logo-100px.png" alt=""><span class="sr-only">(current)</span></a>
              </li>
              <div class="lista-menu d-block d-xl-none d-lg-none d-md-none">
                <li class="nav-item">
                  <a class="nav-link"  href="/SocialHealth/components/dashboard/"> 
                    <button class="iconbtn"><i class="fa fa-home"></i></button>
                    <p>Inicio</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="/SocialHealth/components/chat/"> 
                        <button class="iconbtn"><i class="fas fa-comments"></i></button>
                        <p>Chat</p> 
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="/SocialHealth/components/appointment/">    
                      <button class="iconbtn"><i class="fas fa-calendar-check"></i></button>
                      <p>Citas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="/SocialHealth/components/people/"> 
                      <button class="iconbtn"><i class="fas fa-user"></i></i></button>
                      <p>Pacientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="/SocialHealth/components/record/">
                      <button class="iconbtn"><i class="fas fa-list-ul"></i></button>
                      <p>Historial</p>
                  </a>
                </li>
                <?php if($tipo==2){?>
                <li class="nav-item">
                  <a class="nav-link"  href="/SocialHealth/template/noprogramado.php">
                      <button class="iconbtn"><i class="fas fa-id-card"></i></button>
                      <p>Seguros</p>
                  </a>
                </li>
                <?php };?>
                <li class="nav-item">
                  <a class="nav-link"  href="/SocialHealth/components/settings/">
                      <button class="iconbtn"><i class="fas fa-cog"></i></button>
                      <p>Ajustes</p>
                  </a>
                </li>
              </div>
            </ul>
            <form class="form-inline my-2 my-lg-0 d-none d-md-block d-lg-block  d-xl-block">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <div class="nav-link dropdown-toggle profile-span" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <h6><b><?php echo utf8_decode($row['nombre'])," ",utf8_decode($row['apellido']); ?></h6></b>    <img src="" class="profile-pic"  alt="">
                  </div>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/SocialHealth/components/settings/">Mi Perfil</a>
                    <a class="dropdown-item" href="/SocialHealth/components/settings/">Ajustes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/SocialHealth/components/login/logout.php">Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
            </form>
          </div>
        </nav>
      </div>
      <div class="container-fluid">
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
          