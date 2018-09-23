<?php
session_start();
require "../../functions/connection.php";
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: ../login/");
	}
  $idUsuario = $_SESSION['id_usuario'];
  $id_tipo = $_SESSION['tipo_usuario'];


$query = "SELECT `ID_Region`, `Nombre` FROM `region` ORDER BY Nombre";
$S_region=$mysqli->query($query);
$query= "SELECT `ID_Especialidad`, `Nombre_Esp`, `Descripcion` FROM `especialidades`";
$S_especialidad=$mysqli->query($query);

//conexion
//cargar datos desde la base y guardar.
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Bienvenido </title>

    <script src="/SocialHealth/public/js/jquery-3.3.1.js"></script>
		
		<script>
			$(document).ready(function(){
				$("#region").change(function () {

					//$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#region option:selected").each(function () {
						id_region = $(this).val();
            $.post("../DBConnect/getProvincia.php", { id_region: id_region }, function(data){
							$("#provincia").html(data);
						});            
					});
				})
			});
			
    </script>
  </head>
  <body>
      <div class="container-fluid">

          <div class="row">
              <div class="col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1"></div>

              <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10">
                  <div>
                      <br>
                      <br>
                  </div>
                  <div class="form-control cuadro" style="margin-left:auto; margin-right:auto;" >
                        <form role="form" method="POST" action="../DBConnect/GuardarPro.php">
                                <input type="hidden" name="id" value="<?php echo $idUsuario ?>">
                                <input type="hidden" name="id_tipo" value="<?php echo $id_tipo ?>">
                                <h3 style="text-align: center;color: #2C3E50;">Recopilacion de datos</h3>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <div class="dropdown">
                                      <label for="list">Selecciona</label><br>
                                      <button style="background-color: #00A89E;width: 100%;" class="btn btn-info dropdown-toggle" type="button" id="list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Especialidades
                                      </button>
                                      <br><br>  
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="list">
                                      <?php while($row = $S_especialidad->fetch_assoc()) { ?>
                                        <div class="dropdown-item form-check form-group">
                                          <label class="form-check-label" style="display:inline;" alt="<?php echo $row['Descripcion'] ?>" >
                                              <input class="form-check-input" style="display:inline; width: 13px; " type="checkbox" name="especialidades[]" id="especialidades[]" value="<?php echo $row['ID_Especialidad'] ?>">
                                          <?php echo utf8_encode($row['Nombre_Esp'])?></label>
                                        </div>
                                        <?php } ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="nss">Inhabilitado</label>
                                    <input type="number" class="form-control" id="nss" placeholder="NO se sabe todavia">
                                  </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="nacimiento">Nacimiento</label>
                                        <input type="date" class="form-control" id="nacimiento" name="nacimiento" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sexo">Sexo</label>
                                        <select name="sexo" id="sexo" class="form-control" style="height: 51px;">
                                            <option value="0">Selecciona...</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Indefinido">Prefiero no decirlo</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="telefono">Contacto</label>
                                        <input type="tel" name="telefono" id="telefono" placeholder="Telefono" class="form-control" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="cedula">Cedula</label>
                                        <input type="text" name="cedula" id="cedula" placeholder="Cedula" class="form-control" required>
                                    </div>
                                </div>
                                    <div class="form-group">
                                  <label for="direccion">Direccion</label>
                                  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Casa, Apartameto" required>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-5">
                                        <div>
                                        <label for="region">Region</label>
                                          <select name="region" id="region" class="form-control" style="height: 51px;">
                                          <option value="0">Selecciona...</option>
                                          <?php while($row = $S_region->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['ID_Region']; ?>"><?php echo utf8_encode($row['Nombre']); ?></option>
                                          <?php } ?>
                                          </select>
                                        </div>
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label for="provincia">Provincia</label>
                                    <select id="provincia" name="provincia" class="form-control" style="height: 51px;">
                                    </select>
                                  </div>
                                  <div class="form-group col-md-3">
                                    <label for="inputZip">Zip</label>
                                    <input type="text" class="form-control" id="inputZip" required>
                                  </div>
                                </div>
                                <button type="submit" class="action-button btn btn-info">Guardar</button>
                              </form>
                    </div>
                    
              </div>
            <div class="col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1"></div>
            </div>
        </div>
            
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS ->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>