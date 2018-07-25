<?php
require '../login/funcs/conexion.php';
require 'DB_Usuario.php';
if(!empty($_POST))
{
    $fecha = $mysqli->real_escape_string($_POST['fecha']);	
    $hora = $mysqli->real_escape_string($_POST['hora']);
    $descripcion = $mysqli->real_escape_string($_POST['descripcion']);	
    $id = $mysqli->real_escape_string($_POST['ID_Pac']);	
    
    if(registraCita($id,$fecha,$descripcion,$hora)){
       $mensaje="Guardado con exito";
    }else{
        $mensaje="Error al guardar";
    }
}

?>
<html>
	<head>
		<title>Registro</title>
		<link rel="stylesheet" href="../Menu/css/bootstrap.min.css" >
		<link rel="stylesheet" href="../Menu/css/bootstrap.css" >
		<link rel="stylesheet" href="../login/css/style.css">
		<script src="../login/js/bootstrap.js" ></script>
		
	</head>
	
	<body>
		<div class="container">
			<br>
			<br>
			<br>
			<div class="cuadro" style="background-color: #fff;">
				<h3><?php echo $mensaje; ?></h3>
                <h2>Ya esta todo listo!!</h2>
				<br />
				<p><a class="btn btn-info action-button" href="../Tablas/index.php" role="button">Continuar</a></p>
			</div>
		</div>
	</body>
</html>		