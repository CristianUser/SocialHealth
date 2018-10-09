<?php
	
	require '../../functions/connection.php';
	require '../../functions/funcs.php';
	
	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$token = $mysqli->real_escape_string($_POST['token']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$con_password = $mysqli->real_escape_string($_POST['con_password']);
	
	if(validaPassword($password, $con_password))
	{
		
		$pass_hash = hashPassword($password);
		
		if(cambiaPassword($pass_hash, $user_id, $token))
		{
			echo '	
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
									<p>Contraseña Cambiada</p>
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
			} else {
			
			echo '
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
								<p>Error al cambiar Contraseña</p>
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
			
		}
		
		} else {
		
		echo 'Las contraseñas no coinciden';
		
	}
	
?>	