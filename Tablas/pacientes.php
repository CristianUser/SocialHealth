<?php
require '../login/funcs/conexion.php';
include '../Menu/welcome.php';


//$sql = "SELECT USR.nombre, USR.apellido FROM usuario USR WHERE USR.id_usuario in (SELECT ID_Cliente FROM r_paciente WHERE ID_Profesional = 4)";
$where="WHERE ID_Profesional = 0)";
if(!empty($_POST))
	{
		$valor = $_POST['campo'];
		if(!empty($valor)){
			$where = "WHERE ID_Profesional = $valor)";
		}
	}
$sql = "SELECT id_usuario, nombre, apellido, usuario FROM usuario WHERE id_usuario in (SELECT ID_Cliente FROM r_paciente $where";
//$sql = "SELECT * FROM usuario";
$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <!--script src="js/jquery-3.3.1.slim.min.js"></script-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script type="text/Javascript">
           $(document).ready(function(){
		$('#mitabla').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['copy', 'csv', 'excel', 'pdf', 'print' ],
			"order": [[1, "asc"]],
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
           <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>ID_Pro </b><input type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn " />
				</form>
        </div>
        </div>
        <br>
       
       <div class="row table-responsive">
           <table class="tabla table table-striped table-bordered dt-responsive nowrap" id="mitabla" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_usuario']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['usuario']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
           </table>

       </div>

    </div>
    <!-- Modal -->
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
    <!--script src="js/jquery-3.3.1.slim.min.js"></script-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>