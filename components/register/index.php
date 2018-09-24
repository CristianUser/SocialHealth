<?php
	
	require '../../functions/connection.php';
	require '../../functions/funcs.php';
	
	$errors = array();
	
	if(!empty($_POST))
	{
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $apellido = $mysqli->real_escape_string($_POST['apellido']);	
		$usuario = $mysqli->real_escape_string($_POST['usuario']);	
		$password = $mysqli->real_escape_string($_POST['password']);	
		$con_password = $mysqli->real_escape_string($_POST['con_password']);	
		$email = $mysqli->real_escape_string($_POST['email']);	
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		
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
                //******************************************************************************************* */
                
                $id_insert=$registro;
                if($_FILES["upload"]["error"]>0){
                    echo "error al cargar archivo";
                }else{
                    $permitidos = array("image/gif","image/png","image/jpeg","image/jpg","application/pdf");
                    $limite_kb = 2000;
               
                    if(in_array($_FILES["upload"]["type"], $permitidos) && $_FILES["upload"]["size"] <= ($limite_kb * 1024)){
                       $ruta = '../../private/files/'.$id_insert.'/';
                       $archivo = $ruta.'perfil.png';
               
                       if(!file_exists($ruta)){
                           mkdir($ruta);
                       }
                       if(!file_exists($archivo)){
                           $resultado = @move_uploaded_file($_FILES["upload"]["tmp_name"],$archivo);
                           if($resultado){
                               echo "Archivo guardado";
                           }else{
                               echo "Error al guardar";
                           }
                           
                           
                       }else{
                           echo "Archivo ya existente";
                       }
                    }else{
                        echo "Archivo no permitido";
                    }
                }

                // **********************************---------------------------------------------*********************************************************
				
				if($registro > 0 )
				{
					
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/SocialHealth/components/register/activar.php?id='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta - SocialHealth';
					$cuerpo = "Estimado $nombre $apellido: <br /><br />Para continuar con el proceso de registro, es indispensable de click en <a href='$url'>Activar Cuenta</a>";
					
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
                    echo`
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SocialHealth</title>
    <link rel="stylesheet" type="text/css" href="/SocialHealth/public/css/bootstrap.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="/SocialHealth/components/register/css/style.css">
    <style>
        .opcion-active {
            box-shadow: 0 0 5px 1px rgb(68, 224, 185);
        }
    </style>
</head>
<body>

    <div>
    <form id="msform" class="" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- progressbar -->
            <div class="progressbars">
                <ul id="progressbar">
                    <li class="active">Cuenta</li>
                    <li>Tipo de cuenta</li>
                    <li>Datos personales</li>
                </ul>
            </div>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Crea tu cuenta</h2>
                <h3 class="fs-subtitle">Paso 1</h3>
                <input type="text" name="email"  placeholder="Email" required />
                <input type="password" name="password"  placeholder="Contraseña" required />
                <input type="password" name="con_password"  placeholder="Confirmar Contraseña" required />
                <a href="/SocialHealth/components/login/"class="a">Iniciar Sesion</a>
                <input type="button" name="next"  class="next action-button" value="Siguiente" required />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Tipo de cuenta</h2>
                <h3 class="fs-subtitle">Elije uno</h3>
                <div class="form-group">
                    <div class="row">
                        <div id="opt1" class="col">
                            <label class="opt1"><img class="opcion" src="/SocialHealth/assets/images/paciente.png" alt="">
                                <input style="display:none;" type="radio" name="tipo" id="tipo1"value="1"  ><h3 class="fs-subtitle"style="display: inline;">Paciente</h3>
                            </label>
                        </div>
                        <div id="opt2" class="col">
                            <label class="opt2"><img class="opcion" src="/SocialHealth/assets/images/doctor.png" alt="">
                                <input style="display:none;" type="radio" name="tipo" id="tipo2"value="2"  ><h3 class="fs-subtitle"style="display: inline;">Odontologo</h3>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="button" name="previous" class="previous action-button" value="Atras" />
                <input type="button" name="next" class="next action-button" value="Siguiente" />
            </fieldset>

            <fieldset>
                <h2 class="fs-title">Datos personales</h2>
                <h3 class="fs-subtitle">Sube una foto</h3>
                <label for="upload"><img id="image" class="profile" src="/SocialHealth/assets/images/perfil.jpg" alt="Selecciona una foto"></label>
                <input class="upload" id="upload" type="file" name="upload" >
                <input type="text" name="nombre" placeholder="Nombre" required />
                <input type="text" name="apellido" placeholder="Apellido" required />
                <input type="text" name="usuario" placeholder="Username"/>
                <div style="overflow:hidden;" class="g-recaptcha col-md-9" data-sitekey="6Lcdn2EUAAAAAN_-AvR4IYjwioCEYMTwqevoQOjO"></div>
                <input type="button" name="previous" class="previous action-button" value="Atras" />
                <button id="btn-signup" type="submit" class="action-button btn btn-info">Registrar</button> 
            </fieldset>
        </form>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <?php echo resultBlock($errors); ?>
            </div>
            <div class="col"></div>
        </div>
    </div>



    <!--script src="js/jquery-3.3.1.slim.min.js"></script-->
    <!--script src="js/popper.min.js"></script-->
    <!--script src="js/bootstrap.min.js"></script-->
    <script src="/SocialHealth/public/js/jquery-3.3.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script>
        var opt1 = document.getElementById('opt1');
        var opt2 = document.getElementById('opt2');
        opt1.addEventListener('click',()=>{
            opt1.children[0].children[0].className="opcion opcion-active";
            opt2.children[0].children[0].className="opcion";
        });
        opt2.addEventListener('click',()=>{
            opt2.children[0].children[0].className="opcion opcion-active";
            opt1.children[0].children[0].className="opcion";
        });
              function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                        
                        document.getElementById("image").src = e.target.result;
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('upload').addEventListener('change', archivo, false);
      </script>
    <script>
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            
            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            
            //show the next fieldset
            next_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                'transform': 'scale('+scale+')',
                'position': 'absolute'
            });
                    next_fs.css({'left': left, 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".submit").click(function(){
            return false;
        })

    </script>
</body>
</html>