<?php
require '../login/funcs/conexion.php';
require 'DB_Usuario.php';
if(!empty($_POST))
{
    $especialidades = $_POST['especialidades'];	
    $nacimiento = $mysqli->real_escape_string($_POST['nacimiento']);	
    $sexo = $mysqli->real_escape_string($_POST['sexo']);	
    $telefono = $mysqli->real_escape_string($_POST['telefono']);	
    $cedula = $mysqli->real_escape_string($_POST['cedula']);		
    $direccion = $mysqli->real_escape_string($_POST['direccion']);	
    $provincia = $mysqli->real_escape_string($_POST['provincia']);
    $tipo_usuario = $mysqli->real_escape_string($_POST['id_tipo']);
    $id = $mysqli->real_escape_string($_POST['id']);
    
    if(registraDatosPro($id, $especialidades, $nacimiento, $sexo, $telefono, $cedula, $provincia, $direccion)){
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
		<script src="../Menu/js/bootstrap.js" ></script>
		
	</head>
	
	<body>
		<div class="container">
			<br>
			<br>
			<br>
			<div class="cuadro" style="background-color: #fff;">
				<h3><?php echo $mensaje; ?></h3>
                <h2>Ya esta todo listo!!</h2>
                <h3>Bienvenido</h3>
				
				<br />
				<p><a class="btn btn-info action-button" href="../Menu/welcome.php" role="button">Continuar</a></p>
			</div>
		</div>
	</body>
</html>		