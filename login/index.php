<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	session_start(); //Iniciar una nueva sesión o reanudar la existente
	
	if(isset($_SESSION["id_usuario"])){ //En caso de existir la sesión redireccionamos
		header("Location: ../Menu/welcome.php");
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
		
		$errors[] = login($usuario, $password);	
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--link rel="stylesheet" type="text/css" href="css/Bootstrap.css"-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div>
    <form id="msform" class="" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
            <fieldset>
                <h2 class="fs-title">SocialHealth</h2>
                <h3 class="fs-subtitle">Iniciar Sesion</h3>
                <input type="text" name="usuario" id="usuario" placeholder="Email" required />
                <input type="password" name="password" id="password" placeholder="Contraseña" required />
                <div  style=" font-size: 80%; position: relative; top:-10px"><a class="a" href="recupera.php">¿Se te olvid&oacute; tu contraseña?</a></div>
                <a class="a" href="registro.php">Crear Cuenta</a>
                <input type="submit" class="action-button" value="Iniciar Sesion">
            </fieldset>
        </form>
    </div>



    <!--script src="js/jquery-3.3.1.slim.min.js"></script-->
    <!--script src="js/popper.min.js"></script-->
    <!--script src="js/bootstrap.min.js"></script-->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</body>
</html>