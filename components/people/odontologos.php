<?php
include '../../functions/sesionPac.php';
$where="WHERE rp.ID_Cliente = $idUsuario";
$sql = "SELECT * FROM usuario usr INNER JOIN datos_profesional dp 
ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario INNER JOIN 
r_paciente rp on rp.ID_Profesional = dp.ID_Usuario $where";
$resultado = $mysqli->query($sql);
$sql1="SELECT ID_Pac FROM r_paciente  $where";

$contador=0;/*
function seguro($id){
    global $mysqli;
    $s = "SELECT * FROM seguro WHERE ID_Seguro = $id";
    $r = $mysqli->query($s);
    $rr=$r->fetch_assoc();
    echo $rr['Nombre'];
}*/
?>
<?php include  '../../template/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/Javascript">
           $(document).ready(function(){
		$('#mitabla').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['excel','pdf','copy','print','colvis'],
            "pageLength": 7,
			"order": [[0, "dsc"]],
			"language":{
				"lengthMenu": "Mostrar _MENU_ por pagina",
				"info": "Mostrando pagina _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros disponibles",
				"infoFiltered": "(filtrada de _MAX_ registros)",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search": "Buscar:",
				"zeroRecords":    "No se encontraron registros coincidentes",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			},
            "Processing": true,
			//"ServerSide": true,
			//"ajax": "procesar.php"
		});	
	});	
    </script>

</head>
<body>
    <br>
    <div class="row">
    <div class=""></div>
    <div class="container">

        <div class="row">
            <div class="col">
                <h2 style="text-align: center;">Odotologos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-cmj" data-toggle="modal" data-target="#exampleModal">Agregar odontologo</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Buscar Odontologo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="../DBConnect/AgregarOdontologo.php">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="<?php echo $idUsuario; ?>">
                                    <input type="hidden" name="url" id="url" value="<?php $h= $_SERVER["HTTP_HOST"]; $u= $_SERVER["REQUEST_URI"]; echo "http://" . $h . $u;?>">
                                    <label for="username">Nombre de usuario</label><br>
                                    <input type="text" name="username" id="username">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
                                    <button type="submit" class="btn btn-cmj">Agregar</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
       <div class="row">
           <div class="col">
               <div class="row table-responsive">
                   <table class="tabla table table-striped dt-responsive nowrsap display" id="mitabla" style="width: 100%;">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Nombre</th>
                               <th>Telefono</th>
                               <th>Correo</th>
                               <th>Cita</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $idsel=-1; while($row = $resultado->fetch_assoc()) { $contador+=1; ?>
                                <tr>
                                    <td><?php echo $row['id_usuario']; ?></td>
                                    <td>

                                       
                                        <a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/SocialHealth/Tablas/infoOdontologo.php?id=<?php echo $row['id_usuario']; ?>">
                                        <?php echo $row['nombre']," ",$row['apellido']; ?>
                                    </a>
                                    </td>
                                    <td><?php echo $row['Telefono']; ?></td>                                  
                                    <td><?php echo $row['correo']; ?></td>
                                    <td>
                                        <!-- Button to trigger modal -->
                                        <button class="btn btn-cmj" data-toggle="modal" data-target="#modalForm">
                                            Citar
                                        </button>  
                                            <!-- Modal -->
                                        <div class="modal1">
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalForm" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Programar Cita</h4>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span aria-hidden="true">×</span>
                                                                <span class="sr-only">Close</span>
                                                            </button>
                                                        </div>
                                                        
                                                        <!-- Modal Body -->
                                                        <div class="modal-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="POST" action="../DBConnect/GuardarCita.php">
                                                                <input type="hidden" name="ID_Pac" id="ID_Pac" value="<?php echo $row['ID_Pac']; ?>">
                                                                <input type="hidden" name="url" id="url" value="<?php $h= $_SERVER["HTTP_HOST"]; $u= $_SERVER["REQUEST_URI"]; echo "http://" . $h . $u;?>">
                                                                <div class="form-group">
                                                                    <label for="fecha">Fecha</label>
                                                                    <input type="date" class="form-control" name="fecha" id="fecha" required/>
                                                                </div>
                                                                <!--div class="form-group">
                                                                    <div class="input-group date" id="fecha" data-target-input="nearest">
                                                                    <input name="fecha" type="text" class="form-control datetimepicker-input" id="fecha"
                                                                        data-toggle="datetimepicker" data-target="#fecha"/>
                                                                    </div>
                                                                </div-->
                                                                <div class="form-group">
                                                                    <label for="hora">Hora</label><br>
                                                                    <select name="hora" id="hora">
                                                                        <option value="0">Selecciona</option>
                                                                        <option value="8:00">8:00 AM</option>
                                                                        <option value="9:00">9:00 AM</option>
                                                                        <option value="10:00">10:00 AM</option>
                                                                    </select>
                                                                    
                                                                </div>
                                                                <!--div class="form-group">
                                                                    <div class="input-group date" id="hora" data-target-input="nearest">
                                                                    <input name="hora" type="text" class="form-control datetimepicker-input" id="hora"
                                                                        data-toggle="datetimepicker" data-target="#hora"/>
                                                                        
                                                                    </div-->
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="descripcion">Descripcion</label>
                                                                    <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Enter your message"></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Atras</button>
                                                                    <button type="submit" class="btn btn-primary submitBtn btn-cmj" >Enviar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                        <!-- Modal Footer -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                             
                                    </td>
                                </tr>
                                <?php } if($contador <10){for($x=1;$x<=(10-$contador);$x++){ ?>
                                    <tr>
                                        <td>0</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>

    </div>

    <!--script src="js/jquery-3.3.1.slim.min.js"></script->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script-->
</body>
</html>
<?php include '../../template/footer.php'; ?>