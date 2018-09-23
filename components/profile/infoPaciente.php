<?php 
include '/Socialhealth/functions/sessions/sesionPro.php';
$where="WHERE ID_Profesional = $idUsuario";
$sql = "SELECT * FROM usuario usr INNER JOIN datos_cliente dp 
ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario in 
(SELECT ID_Cliente FROM r_paciente $where)";
$resultado = $mysqli->query($sql);
$id=$_GET['id'];
$sql2 = "SELECT * FROM usuario usr INNER JOIN datos_cliente dc ON usr.id_usuario = dc.ID_Usuario and dc.ID_Usuario=$id";
$out = $mysqli->query($sql2);
$rows = $out->fetch_assoc();

$img_file2 = "/Socialhealth/private/files/$id/perfil.png";
if(!file_exists($img_file2)){
  $img_file2 = "/Socialhealth/assets/images/perfil.jpg";
}
$imgData2 = base64_encode(file_get_contents($img_file2));
$perfil = 'data: '.mime_content_type($img_file2).';base64,'.$imgData2;
function provincia($id){
  global $mysqli;
  $s = "SELECT * FROM provincias WHERE ID_Provincia = $id";
  $r = $mysqli->query($s);
  $rr=$r->fetch_assoc();
  echo $rr['Nombre'];
}

include 'header.php' ?>
<!DOCTYPE html>
<html>
<title>SocialHealth</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Socialhealth/components/profile/css/perfil-pro-w3.css">
<link rel='stylesheet' href="/Socialhealth/components/profile/css/perfil-pro-css-font.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="<?php echo $perfil;?>" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2 style="background-color:rgba(255, 255, 255, 0.207);border-radius: 3px;"><?php echo utf8_encode($rows['nombre'])," ",utf8_encode($rows['apellido']);?></h2>
          </div>
        </div>
        <div class="w3-container">
          <hr>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>No se que ponerle<p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['Direccion'].", "; provincia($rows['ID_Provincia']);?></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['correo'];?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['Telefono'];?></p>
          <hr>
        </div>
      </div><br>

          <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Opciones</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>No se que poner</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Buennno!</h6>
          
          <br>
        </div>
      </div>
    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
    <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Historia Clinica</h2>
        <div class="w3-container">
          <h5 class="w3-opacity">Titulo</b></h5>
          <!--h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - <span class="w3-tag w3-teal w3-round">Current</span></h6-->
          <p>Contenido</p>
          <hr>
        </div>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<!--footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer-->

</body>
</html>
<?php include 'footer.php' ?>
