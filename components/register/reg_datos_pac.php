<?php
session_start();
require "funcs/conexion.php";
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
  $idUsuario = $_SESSION['id_usuario'];
  $id_tipo = $_SESSION['tipo_usuario'];


$query = "SELECT `ID_Region`, `Nombre` FROM `region` ORDER BY Nombre";
$S_region=$mysqli->query($query);
$query= "SELECT `ID_Seguro`, `Nombre`, `Page_Link` FROM `seguro`";
$S_seguro=$mysqli->query($query);

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

    <script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		
		<script language="javascript">
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
                  <div class="form-control cuadro" style="" >
                        <form role="form" method="POST" action="../DBConnect/GuardarPac.php">
                          <input type="hidden" name="id" value="<?php echo $idUsuario ?>">
                          <input type="hidden" name="id_tipo" value="<?php echo $id_tipo ?>">
                                <h3 style="text-align: center;color: #2C3E50;">Recopilacion de datos</h3>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="seguro">Seguro</label>
                                    <select name="seguro" id="seguro" class="form-control" style="height: 51px;">
                                        <option value="0">Selecciona...</option>
                                        <?php while($row = $S_seguro->fetch_assoc()) { ?>
                                          <option value="<?php echo $row['ID_Seguro']; ?>"><?php echo $row['Nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="nss">NSS</label>
                                    <input type="text" class="form-control" id="nss" name="nss" placeholder="NSS">
                                  </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="nacimiento">Nacimiento</label>
                                        <input type="date" class="form-control" id="nacimiento" name="nacimiento" placeholder="" required>
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
                                        <input type="text" name="cedula" id="cedula" placeholder="Cedula" class="form-control">
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
                                            <option value="<?php echo $row['ID_Region']; ?>"><?php echo $row['Nombre']; ?></option>
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