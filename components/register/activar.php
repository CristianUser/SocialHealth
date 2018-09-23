<?php
	
	require '../../functions/connection.php';
	require '../../functions/funcs.php';
	if(isset($_GET["id"]) AND isset($_GET['val']))
	{
		
		$idUsuario = $_GET['id'];
		$token = $_GET['val'];
		
		$mensaje = validaIdToken($idUsuario, $token);	
	}
?>

<html>
	<head>
		<title>Registro</title>
		<link rel="stylesheet" href="/SocialHealth/public/css/bootstrap.css" >
		
	</head>
	
	<body>
		<div class="container">
			<br>
			<br>
			<br>
			<div class="cuadro" style="background-color: #fff;">
				
				<h1><?php echo $mensaje; ?></h1>
				
				<br />
				<p><a class="btn btn-info action-button" href="/SocialHealth/components/login/" role="button">Iniciar Sesi&oacute;n</a></p>
			</div>
		</div>
		<script src="/SocialHealth/public/js/bootstrap.js" ></script>
	</body>
</html>														