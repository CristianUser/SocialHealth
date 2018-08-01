<?php 
include 'Sesion_Pac.php';
$id=$_GET['id'];
$sql2 = "SELECT * FROM usuario usr INNER JOIN datos_profesional dc ON usr.id_usuario = dc.ID_Usuario and dc.ID_Usuario=$id";
$out = $mysqli->query($sql2);
$rows = $out->fetch_assoc();

$sql3 = "SELECT * FROM especialidades esp, r_especialidades resp WHERE esp.ID_Especialidad = resp.ID_Especialidad and resp.id_usuario=$id";
$esp = $mysqli->query($sql3);

$img_file2 = "../login/files/$id/perfil.png";
if(!file_exists($img_file2)){
  $img_file2 = "images/perfil.jpg";
}

// A few settings
//$img_file = 'raju.jpg';

// Read image path, convert to base64 encoding
$imgData2 = base64_encode(file_get_contents($img_file2));

// Format the image SRC:  data:{mime};base64,{data};
$perfil = 'data: '.mime_content_type($img_file2).';base64,'.$imgData2;

include 'header.php' ?>
<!DOCTYPE html>
<html>
<title>SocialHealth</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/perfil-pro-w3.css">
<link rel='stylesheet' href="css/perfil-pro-css-font.css">
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
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Odontologo<p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['Direccion'];?></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['correo'];?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['Telefono'];?></p>
          <hr>

          <!--p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Habilidades</b></p>
          <p>Adobe Photoshop</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
          </div>
          <p>Photography</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
              <div class="w3-center w3-text-white">80%</div>
            </div>
          </div>
          <p>Illustrator</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
          </div>
          <br-->
        </div>
      </div><br>

          <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Opciones</h2>
        <!--div class="w3-container">
          <h5 class="w3-opacity"><b>Liceo Don Pepe </b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
          <p>Master Degree</p>
          <hr>
        </div-->
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Programar Cita</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Horarios</h6>
          
          <br>
        </div>
      </div>
    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Especialidades</h2>
        <?php while($row = $esp->fetch_assoc()) {?>
        <div class="w3-container">
          <h5 class="w3-opacity"><b><?php echo utf8_encode($row['Nombre_Esp']); ?></b></h5>
          <!--h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - <span class="w3-tag w3-teal w3-round">Current</span></h6-->
          <p><?php echo utf8_encode($row['Descripcion']); ?></p>
          <hr>
        </div>
        <?php };?>
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
