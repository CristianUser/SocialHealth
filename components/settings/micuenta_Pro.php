<?php 
include '../../functions/sesionPro.php';
$id=$_SESSION['id_usuario'];
$sql2 = "SELECT * FROM usuario usr INNER JOIN datos_profesional dc ON usr.id_usuario = dc.ID_Usuario and dc.ID_Usuario=$id";
$out = $mysqli->query($sql2);
$rows = $out->fetch_assoc();

$sql3 = "SELECT * FROM especialidades esp, r_especialidades resp WHERE esp.ID_Especialidad = resp.ID_Especialidad and resp.id_usuario=$id";
$esp = $mysqli->query($sql3);

$img_file2 = "../../private/files/$id/perfil.png";
if(!file_exists($img_file2)){
  $img_file2 = "../../assets/images/perfil.jpg";
}
$imgData2 = base64_encode(file_get_contents($img_file2));
$perfil = 'data: '.mime_content_type($img_file2).';base64,'.$imgData2;

include '../../template/header.php' ?>
<!DOCTYPE html>
<html>
<title>SocialHealth</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/SocialHealth/components/profile/css/perfil-pro-w3.css">
<link rel='stylesheet' href="/SocialHealth/components/profile/css/perfil-pro-css-font.css">
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
            <h2 style="background-color:rgba(255, 255, 255, 0.207);border-radius: 3px;"><?php echo utf8_encode($rows['nombre'])," ",utf8_encode($rows['apellido']);?>
            </h2>
          </div>
        </div>
        <div class="w3-container">
          <hr>
          <button type="button" class="btn btn-cmj" data-toggle="modal" data-target="#cambiarfoto">
            <!--img class="btn-cmxj" style="width:40px; display:inline;" src="../Tablas/icons/Menu Interface-06-WF.png" alt=""-->Cambiar Foto
          </button>
          <hr>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Odontologo<p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>La Vega, Rep Dom</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['correo'];?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $rows['Telefono'];?></p>
          <hr>
        </div>
      </div><br>

          <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Opciones</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Ajustes</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Horarios</h6>
          <button id="buttonConfig" class="btn btn-sm btn-cmj" >Configurar</button>
          <br>  
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
<!-- Modal Cambiar Foto -->
<div class="modal fade" id="cambiarfoto" tabindex="-1" role="dialog" aria-labelledby="cambiarfotoTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subir Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/SocialHealth/functions/dbActions/SubirFoto.php" role="form" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input type="hidden" name="url" id="url" value="<?php $h= $_SERVER["HTTP_HOST"]; $u= $_SERVER["REQUEST_URI"]; echo "http://" . $h . $u;?>">
            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
            <label for="upload">
                <img id="image" style="max-width:100%; " src="/SocialHealth/assets/images/perfil.jpg" alt="Selecciona una foto">
            </label>
            <input hidden class="upload" id="upload" type="file" name="upload" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
            <button type="submit" class="btn btn-cmj">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
    
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
          //Solo admitimos imágenes.
          if (!f.type.match('image.*')) {
              continue;
          }
    
          var reader = new FileReader();
    
          reader.onload = (function(theFile) {
              return function(e) {
                // Insertamos la imagen
              
              document.getElementById("image").src = e.target.result;
              };
          })(f);
    
          reader.readAsDataURL(f);
        }
    }
    
    document.getElementById('upload').addEventListener('change', archivo, false);
    document.getElementById('buttonConfig').addEventListener('click',()=>{
      window.location.href="/SocialHealth/components/config-horario/";
    });
    cargarAjustes = ()=>{
      var parametros = {
      };
      $.ajax({
          url : '../config-horario/index.php',
          data : parametros,
          type : 'GET',
          success : function(res) {
              if (res!=''){
                document.getElementById("contenedor").innerHTML=res;
              }
          },
          error : function(xhr, status) {
              alert('Disculpe, existió un problema');
          },
          complete : function(xhr, status) {
              //console.log('Petición realizada');
          }
      });
    };
    
  </script>
</body>
</html>
<?php include '../../template/footer.php' ?>