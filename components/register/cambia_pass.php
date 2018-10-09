<?php
	
	require '../../functions/connection.php';
	include '../../functions/funcs.php';
	
	if(empty($_GET['user_id'])){
		header('Location: index.php');
	}
	
	if(empty($_GET['token'])){
		header('Location: index.php');
	}
	
	$user_id = $mysqli->real_escape_string($_GET['user_id']);
	$token = $mysqli->real_escape_string($_GET['token']);
	
	if(!verificaTokenPass($user_id, $token))
	{
		echo 'No se pudo verificar los Datos';
		exit;
	}
	
	
?>

<html>
	<head>
		<title>Cambiar Password</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<style>
			input[type="password"]{
				border: 1px solid #ccc;
			}
		</style>
	</head>
	
	<body>
		
		<div class="container">    
			<br><br><br>
		<div class="row">
			<div class="col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs"></div>
			<div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 cuadro2" style="">
				<h3>Cambiar Contraseña</h3>
				<hr>
				<form id="loginform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">
					
					<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
					
					<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
					
					<div class="form-group">
						<label for="password" class="col control-label">Nuevo Password</label>
						<div class="col">
							<input type="password" class="form-control" name="password" placeholder="Password" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="con_password" class="col control-label">Confirmar Password</label>
						<div class="col">
							<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
						</div>
					</div>
					<div style="margin-top:10px" class="form-group">
						<div class="controls">
							<button id="btn-login" type="submit" class="btn btn-cmj">Modificar</a>
						</div>
					</div>   
				</form>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs"></div>
		</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>	