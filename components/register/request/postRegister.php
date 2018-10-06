<?php
	
	require '../../../functions/connection.php';
	require '../../../functions/funcs.php';
	
    $errors = array();
    $sucess='';
	if(!empty($_POST))
	{
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $apellido = $mysqli->real_escape_string($_POST['apellido']);	
		$usuario = $mysqli->real_escape_string($_POST['usuario']);	
		$password = $mysqli->real_escape_string($_POST['password']);	
		$con_password = $mysqli->real_escape_string($_POST['passwordConf']);	
		$email = $mysqli->real_escape_string($_POST['email']);	
        // $captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
        $captcha = $mysqli->real_escape_string($_POST['captcha']);
		
		$activo = 0;
		$tipo_usuario = $mysqli->real_escape_string($_POST['tipo']);
        $secret = '6Lcdn2EUAAAAADW_sf1Y_5xKMC9n4i7KS6XgHQan';
        // **********************************---------------------------------------------*********************************************************
		if(!$captcha){
            $errors[] = "Por favor verifica el captcha";
		}
		
		if(isNull($nombre, $apellido, $usuario, $password, $con_password, $email))
		{
            $errors[] = "Debe llenar todos los campos";
		}
		
		if(!isEmail($email))
		{
            $errors[] = "Dirección de correo inválida";
		}
		
		if(!validaPassword($password, $con_password))
		{
            $errors[] = "Las contraseñas no coinciden";
		}
		
		if(usuarioExiste($usuario))
		{
            $errors[] = "El nombre de usuario $usuario ya existe";
		}
		
		if(emailExiste($email))
		{
            $errors[] = "El correo electronico $email ya existe";
		}
		
		if(count($errors) == 0)
		{
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success'])
			{
                
                $pass_hash = hashPassword($password);
				$token = generateToken();
				
                $registro = registraUsuario($usuario, $pass_hash, $nombre, $apellido, $email, $activo, $token, $tipo_usuario);
				if($registro > 0 )
				{
					
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/SocialHealth/components/register/activar.php?id='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta - SocialHealth';
					$cuerpo = "Estimado $nombre $apellido: <br /><br />Para continuar con el proceso de registro, es indispensable de click en <a href='$url'>Activar Cuenta</a>";
					echo("todo bien");
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
                    
                    $sucess=`
                    <!DOCTYPE html>
                        <html lang='en'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                            <title>SocialHealth</title>
                            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                        </head>
                        <body>
                            <div class='cuadro' style='background-color: #fff;'>
                                <h3>Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email</h3>
                                <br><a href='index.php' >Iniciar Sesion</a>  
                            <div> 
                            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                        </body>
                        </html>
                                            
                    
                    `;			

					exit;
					
					} else {
						$erros[] = "Error al enviar Email";
					}
					
					} else {
					$errors[] = "Error al Registrar";
				}
				
				} else {
				$errors[] = 'Error al comprobar Captcha';
			}
			
		}
		
	}
	
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Registro</title>
  </head>
  <body>
      <div class="row">
          <div class="col">
              <?php echo resultBlock($errors);
                    echo $sucess;
               ?>
            </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>