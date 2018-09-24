<?php
include '../../functions/sesionPro.php';
$where="WHERE ID_Profesional = $idUsuario";
$sql = "SELECT * FROM usuario usr INNER JOIN datos_cliente dp 
ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario in 
(SELECT ID_Cliente FROM r_paciente $where)";
$resultado = $mysqli->query($sql);
$contador=0;
function seguro($id){
    global $mysqli;
    $s = "SELECT * FROM seguro WHERE ID_Seguro = $id";
    $r = $mysqli->query($s);
    $rr=$r->fetch_assoc();
    echo $rr['Nombre'];
}
?>
<?php include  '../../template/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="/SocialHealth/public/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <script type="text/Javascript">
           $(document).ready(function(){
		$('#mitabla').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['copy', 'csv', 'excel', 'pdf', 'print','colvis' ],
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
<body><div class="row">
    <div class=""></div>
    <div class="container">

        <div class="row">
            <div class="col">
                <h2 style="text-align: center;">Pacientes</h2>
            </div>
        </div>
       <div class="row">
           <div class="col">
               <!--a href="nuevo.php" class="btn btn-success">Nuevo Registro</a-->
           </div>
           <div class="col">
           <!--form action="<?php //$_SERVER['PHP_SELF']; ?>" method="POST">
					<b>ID_Pro </b><input type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn " />
				</form-->
        </div>
        </div>
        <br>
       <div class="row">
           <div class="col">
               <div class="row table-responsive">
                   <table class="tabla table table-striped dt-responsive nowrsap display" id="mitabla" style="width: 100%;">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Nombre</th>
                               <th>Telefono</th>
                               <th>Seguro</th>
                               <th>NSS</th>
                               <th>Cedula</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $resultado->fetch_assoc()) { $contador+=1; ?>
                                <tr>
                                    <td><?php echo $row['id_usuario']; ?></td>
                                    <td>
                                        <a href="/SocialHealth/components/profile/infoPaciente.php?id=<?php echo $row['id_usuario']; ?>">
                                        <?php echo $row['nombre']," ",$row['apellido']; ?>
                                    </a>
                                    </td>
                                    <td><?php echo $row['Telefono']; ?></td>                                  
                                    <td><?php seguro($row['ID_Seguro']); ?></td>
                                    <td><?php echo $row['NSS']; ?></td>
                                    <td><?php echo $row['Cedula']; ?></td>
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
    <!-- Modal -->
    </div>
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					
					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-ok">Delete</a>
					</div>
				</div>
			</div>
		</div>

		<script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				
				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
        </script>
    <!--script src="js/jquery-3.3.1.slim.min.js"></script->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script-->
</body>
</html>
<?php include '../../template/footer.php'; ?>