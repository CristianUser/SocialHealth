<?php
require '../login/funcs/conexion.php';
require '../login/funcs/funcs.php';
require 'DB_Usuario.php';
if(!empty($_POST))
{
    $id = $mysqli->real_escape_string($_POST['id']);	
    $username = $mysqli->real_escape_string($_POST['username']);
    if(usuarioExiste($username)){

       $sql = "SELECT * FROM usuario usr WHERE usr.id_tipo=2  AND usr.usuario= '$username' LIMIT 1";
       echo $sql;
        $resultado = $mysqli->query($sql);
        $s=$resultado->fetch_assoc();
        $idpro=$s['id_usuario'];
        if(agregarRPaciente($id,$idpro)){
            $mensaje="Guardado con exito";
        }else{
            $mensaje="Error al guardar $idpro";
        }
    }else{
        $mensaje="El Usuario no existe";
    }
}
//header("Location: ../Tablas/$go");
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
				<p><a class="btn btn-info action-button" href="../Tablas/odontologos.php" role="button">Continuar</a></p>
			</div>
		</div>
	</body>
</html>	