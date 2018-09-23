<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	session_start();
	
	if(isset($_SESSION["id_usuario"])){
		header("Location: welcome.php");
	}
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$email = $mysqli->real_escape_string($_POST['email']);
		
		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}
		
		if(emailExiste($email))
		{			
			$user_id = getValor('id_usuario', 'correo', $email); 
			$nombre = getValor('nombre', 'correo', $email);
			$apellido = getValor('apellido', 'correo', $email);
			
			$token = generaTokenPass($user_id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/SocialHealth/login/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Contraseña - SocialHealth';
			$cuerpo = "Hola $nombre $apellido: <br /><br />Se ha solicitado un reinicio de contraseña. <br/><br/>Para restaurar la contraseña, Pulsa el siguiente enlace: <a href='$url'>Recuperar Contraseña</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				echo"
				<!DOCTYPE html>
					<html lang='en'>
					<head>
						<meta charset='UTF-8'>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'>
						<meta http-equiv='X-UA-Compatible' content='ie=edge'>
						<title>SocialHealth</title>
						<link rel='stylesheet' href='css/bootstrap.min.css' >
						<link rel='stylesheet' href='css/bootstrap-theme.min.css' >
						<link rel='stylesheet' href='css/style.css'>
						<script src='js/bootstrap.min.js' ></script>
					</head>
					<body>
					<div class='cuadro' style='background-color: #fff;'>
				
				<h3>Para terminar el proceso de recuperar tu contraseña siga las instrucciones que le hemos enviado la direccion de correo electronico: $email</h3>
				<br><a href='index.php' >Iniciar Sesion</a>  
				<div> 
					</body>
					</html>
										
				
				";
				exit;
			}
			} else {
			$errors[] = "La direccion de correo electronico no existe";
		}
	}
?>
<html>
	<head>
		<title>SocialHealth-Recuperar Contraseña</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<style>
			.cuadro2{
			text-align: center;
			background-color: white;
			/*border-radius: 5px;*/
			/*border:1px solid #5e5e5e;*/
			padding-bottom: 10px;
			box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.508);
			margin-left: auto;
			margin-right: auto;
}
.btn-cmj {
	background: #00a89e;
	color: white;
	box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.233);
}
		</style>
		
	</head>
	
	<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-3 col-lg-3 col-md-2 col-sm-1 cols-xs"></div>
			<div style="margin-top:50px;" class="col-xl-6 col-lg-6 col-md-8 col-sm-10 cols-xs-12 cuadro2">
				<form id="loginform" class="" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							<h3 style="text-align: center;color: #2C3E50;">Recuperar Contraseña</h3>
							<div style="float:right; font-size: 80%; position: relative;"><a class="a" href="index.php">Iniciar Sesi&oacute;n</a></div>
							<br>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" placeholder="Email" required>
							</div>
							<div>
								<a class="a" href="registro.php">Registrate aquí</a>
								<button type="submit" class="btn btn-cmj">Enviar</button>
							</div>
				</form>
				<?php echo resultBlock($errors); ?>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-2 col-sm-1 cols-xs"></div>
		</div>
</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>							