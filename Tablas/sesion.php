<?php
	session_start();
	require '../login/funcs/conexion.php';
	include '../login/funcs/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: ../index.php");
	}
	
    $idUsuario = $_SESSION['id_usuario'];
    $tipo = $_SESSION['tipo_usuario'];
    $img_file = "../login/files/$idUsuario/perfil.png";
  if(!file_exists($img_file)){
    $img_file = "icons/User-Profile-Inv.png";
  }

  // A few settings
//$img_file = 'raju.jpg';

// Read image path, convert to base64 encoding
$imgData = base64_encode(file_get_contents($img_file));

// Format the image SRC:  data:{mime};base64,{data};
$ruta = 'data: '.mime_content_type($img_file).';base64,'.$imgData;
// Echo out a sample image
  if($tipo==1){
    $sql = "SELECT * FROM usuario usr INNER JOIN datos_cliente dc ON usr.id_usuario = dc.ID_Usuario and dc.ID_Usuario=$idUsuario";
  }elseif($tipo==2){
	$sql = "SELECT * FROM usuario usr INNER JOIN datos_profesional dp ON usr.id_usuario = dp.ID_Usuario and dp.ID_Usuario=$idUsuario";
  }

    $result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
?>