<?php
	require '../../functions/connection.php';
	include '../../functions/funcs.php';
	
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
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/SocialHealth/components/register/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Contraseña - SocialHealth';
			$cuerpo = "Hola $nombre $apellido: <br /><br />Se ha solicitado un reinicio de contraseña. <br/><br/>Para restaurar la contraseña, Pulsa el siguiente enlace: <a href='$url'>Recuperar Contraseña</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				echo'

				<!doctype html>
				<html lang="en">
				<head>
					<!-- Required meta tags -->
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				
					<!-- Bootstrap CSS -->
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
				
					<title>Recuperar</title>
					<style>
					.btn-cmj {
						background: #00a89e;
						color: white;
						box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.233);
					}
					.btn {
				
						display: inline-block;
						font-weight: 400;
						text-align: center;
						white-space: nowrap;
						vertical-align: middle;
						-webkit-user-select: none;
						-moz-user-select: none;
						-ms-user-select: none;
						user-select: none;
						border: 1px solid transparent;
						padding: .375rem .75rem;
						font-size: 1rem;
						line-height: 1.5;
						border-radius: .25rem;
						transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
					
					}
				
					</style>
				</head>
				<body>
					<div class="row">
						<div class="col">
							<div style="text-align:center;">
									<h3>SocialHealth</h3>
									<img style="width:256px" src="/assets/images/logo-original.png" alt="">
									<p>Para terminar el proceso de recuperar tu contraseña siga las instrucciones que le hemos enviado la direccion de correo electronico: '.$email.'</p>
									<a href="/SocialHealth/components/login/"><button class="btn btn-cmj" >Iniciar Sesion</button></a>
								</div>
						</div>
					</div>
					<hr>
					<!-- Optional JavaScript -->
					<!-- jQuery first, then Popper.js, then Bootstrap JS -->
					<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
				</body>
				</html>
										
				
				';
				exit;
			}
			} else {
			$errors[] = "La direccion de correo electronico no existe";
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
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
							<div style="float:right; font-size: 80%; position: relative;"><a class="a" href="/SocialHealth/components/login/">Iniciar Sesi&oacute;n</a></div>
							<br>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" placeholder="Email" required>
							</div>
							<div>
								<a class="a" href="/SocialHealth/components/register/">Registrate aquí</a>
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