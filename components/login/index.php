<?php
	require '../../functions/connection.php';
	include '../../functions/funcs.php';
	
	session_start(); //Iniciar una nueva sesión o reanudar la existente
	
	if(isset($_SESSION["id_usuario"])){ //En caso de existir la sesión redireccionamos
		header("Location:../dashboard/");
	}
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		$errors = login($usuario, $password);	
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SocialHealth</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/Socialhealth/components/register/css/style.css">
</head>
<body>
    <div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <?php echo resultBlock($errors); ?>
            </div>
            <div class="col"></div>
        </div>
    <form id="msform" class="" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
            <fieldset>
                <h2 class="fs-title">SocialHealth</h2>
                <h3 class="fs-subtitle">Iniciar Sesion</h3>
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Email" required />
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" required />
                <div  style=" font-size: 80%; position: relative;"><a class="a" href="/SocialHealth/components/register/recupera.php">¿Se te olvid&oacute; tu contraseña?</a></div>
                <a class="a" href="/SocialHealth/components/register/">Crear Cuenta</a>
                <input type="submit" class="action-button" value="Iniciar Sesion">
            </fieldset>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>