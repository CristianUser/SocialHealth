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
                    $cuerpo = '
                        <!doctype html>
                        <html lang="en">
                        <head>
                            <!-- Required meta tags -->
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                            <!-- Bootstrap CSS -->
                            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

                            <title>Activar</title>
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
                                            <img style="width:256px" src="/assets/images/logo-original.png" alt="">
                                            <h5>Hola '.$nombre.' '.$apellido.'. Gracias por registrarte en SocialHealth</h5>
                                            <p>Estas a un paso de empezar a usar tu cuenta, solo debes acceder a <a href="'.$url.'">este link</a> para activar tu cuenta o pulsar el boton activar.</p>
                                            <a href="'.$url.'"><button class="btn btn-cmj" >Activar!</button></a>
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
                    
                    if(enviarEmail($email, $nombre, $asunto, $cuerpo)){


                    echo'<!--S-->
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>SocialHealth</title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                        <style>
                        .btn-cmj {
                        background: #00a89e;
                        color: white;
                        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.233);
                    }
                    
                        .cuadro .action-button {
                        width: 100px;
                        background: #00A89E;
                        font-weight: bold;
                        color: white;
                        border: 0 none;
                        border-radius: 1px;
                        cursor: pointer;
                        padding: 10px 5px;
                        margin: 10px 5px;
                    }
                    .form-control{
                        border: 0 none;
                        border-radius: 3px;
                        /*box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);*/
                        box-sizing: border-box;
                    }
                    
                    .cuadro{
                        
                        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
                        border: 1px solid #ccc;
                        border-radius: 3px;
                        /*margin-bottom: 10px;*/
                        box-sizing: border-box;
                        font-family: montserrat;
                        color: #2C3E50;
                        font-size: 13px;
                        margin: 0px auto;
                        text-align: center;
                        position: relative;
                    }
                    .cuadro select{
                    height: 51px;
                    }
                    .cuadro input, .cuadro textarea ,.cuadro select{
                        padding: 15px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                        margin-top: 10px;
                        width: 100%;
                        box-sizing: border-box;
                        font-family: montserrat;
                        color: #2C3E50;
                        font-size: 13px;
                    }
                    .cuadro input[type="radio"]{
                        padding: 0px;
                        width: 20%;
                    }
                        </style>
                    </head>
                    <body>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <div class="cuadro" style="background-color: #fff;">
                                <h5>Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: '.$email.'</h5>
                                <a href="SocialHealth/components/login/" ><button class="btn btn-cmj" >Iniciar Sesion</button></a>  
                            <div> 
                        </div>
                        <div class="col"></div>
                        </div>
                            <br>
                            <br>
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                    </body>
                    </html>
                    ';}else{
                        $errors[] = "Error al enviar el Correo";
                    }			
					
					} else {
					$errors[] = "Error al Registrar";
				}
				
				} else {
				$errors[] = 'Error al comprobar Captcha';
			}
			
		}
		
	}
	if($sucess == ''){

?>
<!--E-->
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
              <?php echo resultBlock($errors);?>
            </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
    <?php }else{ echo $sucess;}?>