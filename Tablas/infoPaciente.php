<?php 
include 'Sesion_Pro.php';
$where="WHERE ID_Profesional = $idUsuario";
$sql = "SELECT * FROM usuario usr INNER JOIN datos_cliente dp 
ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario in 
(SELECT ID_Cliente FROM r_paciente $where)";
$resultado = $mysqli->query($sql);
$id=$_GET['id'];
$sql2 = "SELECT * FROM usuario usr INNER JOIN datos_cliente dc ON usr.id_usuario = dc.ID_Usuario and dc.ID_Usuario=$id";
$out = $mysqli->query($sql2);
$rows = $out->fetch_assoc();

$perfil = "../login/files/$id/perfil.png";
  if(!file_exists($perfil)){
    $perfil = "../Tablas/icons/User-Profile-Inv.png";
  }

include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Informacion</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img src="<?php echo $perfil;?>" alt="" class="perfil">
            </div>
            <div class="col"><h4><?php echo utf8_decode($rows['nombre'])," ",utf8_decode($rows['apellido']);?></h4></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col"><h4>Seguro</h4> Senasa</div>
            <div class="col"><h4>Nss</h4> 1214312412</div>
        </div>
        <div class="row">
            <div class="col"><h4>Nacimiento</h4>10/11/1996</div>
            <div class="col"></div>
        </div>
        <div class="row"></div>
        <div class="row"></div>
    </div>
    
</body>
</html>
<?php include 'footer.php' ?>