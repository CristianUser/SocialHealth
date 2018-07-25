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
			$user_id = getValor('id', 'correo', $email); 
			$nombre = getValor('nombre', 'correo', $email);
			
			$token = generaTokenPass($user_id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/SocialHealth/login/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Contraseña - SocialHealth';
			$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				echo "Hemos enviado un correo electronico a las direcion $email para restablecer tu password.<br />";
				echo "<a href='index.php' >Iniciar Sesion</a>";
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