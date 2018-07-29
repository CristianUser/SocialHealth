<?php
	session_start();
	require '../login/funcs/conexion.php';
	include '../login/funcs/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: ../index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
  $ruta = "../login/files/$idUsuario/perfil.png";
  if(!file_exists($ruta)){
    $ruta = "icons/User-Profile.png";
  }
	$sql = "SELECT id_usuario, nombre, apellido FROM usuario WHERE id_usuario = '$idUsuario'";
	$result = $mysqli->query($sql);
	
  $row = $result->fetch_assoc();
  header("Location: ../Tablas");
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../login/">
    <link rel="stylesheet" type="text/css" href="css/Bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/stylenew.css">
    <title>Document</title>
    <style type="text/css">
    
      .nav-pills .nav-link.active, .show > .nav-pills .nav-link {
          color: #fff;
          border: 0px;
          background-color:  rgba(0, 0, 0, 0.316);
      }

    </style>
    <script src="js/jquery-3.3.1.js"></script>
    <script>/*
            $(document).ready(function(){
               $(".nav").mouseover(function(event){
                  $("#cont1").removeClass("col-1");
                  $("#cont2").removeClass("col-11");
                  $("#cont1").addClass("col-2");
                  $("#cont2").addClass("col-10");

               });
               $(".nav").mouseout(function(event){
                  $("#cont1").removeClass("col-2");
                  $("#cont2").removeClass("col-10");
                  $("#cont1").addClass("col-1");
                  $("#cont2").addClass("col-11");
               });
            });*/
            </script>
</head>
<body>
    <div class="container-fluid">
        <header class="header">
                <nav class="navbar navbar-expand navbar-light" style="background-color: #00A89E;">
                        <a class="navbar-brand" href="#"><img style="width: 100px;" src="images/logo.png" alt=""></a>
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

        <a href="../Tablas/index.php">
        <button class='btn btn-danger'> Ir a la pagina</button>
        </a>

        <div class="row">
                <div class="menu" id="cont1">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link2 nav-link active" id="v-pills-inicio-tab" data-toggle="pill" href="#v-pills-inicio" role="tab" aria-controls="v-pills-inicio" aria-selected="true">
                        <img class="icon" src="icons/House-04.png">
                        <div class="nav-title">Inicio</div>
                    </a>
                    <a class="nav-link2 nav-link" id="v-pills-citas-tab" data-toggle="pill" href="#v-pills-citas" role="tab" aria-controls="v-pills-citas" aria-selected="false">
                        <img src="icons/Calendar1-WF.png" class="icon">
                        <div class="nav-title">Citas</div>
                    </a>
                    <a class="nav-link2 nav-link" id="v-pills-pacientes-tab" data-toggle="pill" href="../Tablas/pacientes.php" role="tab" aria-controls="v-pills-pacientes" aria-selected="false">
                        <img src="icons/User Save -01-WF.png" class="icon">
                        <div class="nav-title">Pacientes</div>
                    </a>
                    <a class="nav-link2 nav-link" id="v-pills-historial-tab" data-toggle="pill" href="#v-pills-historial" role="tab" aria-controls="v-pills-historial" aria-selected="false">
                        <img src="icons/To Do List-WF.png" alt="" class="icon">
                        <div class="nav-title">Historial</div>
                    </a>
                    <a class="nav-link2 nav-link" id="v-pills-seguros-tab" data-toggle="pill" href="#v-pills-seguros" role="tab" aria-controls="v-pills-seguros" aria-selected="false">
                        <img src="icons/Identity-WF.png" alt="" class="icon">
                        <div class="nav-title">Seguros</div>
                    </a>
                    <a class="nav-link2 nav-link" id="v-pills-ajustes-tab" data-toggle="pill" href="#v-pills-ajustes" role="tab" aria-controls="v-pills-ajustes" aria-selected="false">
                        <img src="icons/Settings-WF.png" alt="" class="icon">
                        <div class="nav-title">Ajustes</div>
                    </a>
                  </div>
                </div>
                <div class=""></div>
                <div class="contenido" id="cont2">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">Estas en inicio</div>
                    <div class="tab-pane fade" id="v-pills-citas" role="tabpanel" aria-labelledby="v-pills-citas-tab"><h1></h1> </div>
                    <div class="tab-pane fade" id="v-pills-pacientes" role="tabpanel" aria-labelledby="v-pills-pacientes-tab">
                      <!--?php require_once '../Tablas/pacientes.php';?-->
                      Estas en pacientes</div>
                    <div class="tab-pane fade" id="v-pills-historial" role="tabpanel" aria-labelledby="v-pills-historial-tab">Estas en Historial</div>
                    <div class="tab-pane fade" id="v-pills-seguros" role="tabpanel" aria-labelledby="v-pills-seguros-tab">Estas en Seguros</div>
                    <div class="tab-pane fade" id="v-pills-ajustes" role="tabpanel" aria-labelledby="v-pills-ajustes-tab">Estas en Ajustes</div>
                  </div>
                </div>
              </div>

    </div>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>