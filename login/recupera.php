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
		
		<!--link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" -->
		<link rel="stylesheet" href="../Menu/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/bootstrap.min.js" ></script>
		
	</head>
	
	<body>
	<div class="container-fluid">

<div class="row">
	<div class="col-3"></div>

	<div class="col">
		<div>
			<br>
			<br>
		</div>
		<div class="form-control cuadro" style="" >
			  <form id="loginform" class="form-control" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
					  <h3 style="text-align: center;color: #2C3E50;">Recuperar Contraseña</h3>
					  <div style="float:right; font-size: 80%; position: relative; top:-10px"><a class="a" href="index.php">Iniciar Sesi&oacute;n</a></div>
					  <br>
					 <div class="form-group">
						 <label for="email">Email</label>
						 <input type="email" name="email" id="email" placeholder="Email" required>
					 </div>
					 	<a class="a" href="registro.php">Registrate aquí</a>
					  <button type="submit" class="action-button btn btn-info">Enviar</button>
				</form>
				<?php echo resultBlock($errors); ?>
		  </div>
		  
	  </div>
	  <div class="col-3"></div>
  </div>
</div>

		<script src="js/jquery-3.1.1.min.js"></script>
        <script src="../Menu/js/popper.min.js"></script>
    	<script src="../Menu/js/bootstrap.js"></script>
	</body>
</html>							