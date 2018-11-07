<?php
include '../../functions/sesionPac.php';
$where="WHERE rp.ID_Cliente = $idUsuario";
$sql = "SELECT ci.Fecha, ci.Estado, ci.horaInicio as start, ci.horaFin as end, ci.Descripcion, usr.id_usuario, usr.nombre, usr.apellido 
FROM citas ci , r_paciente rp ,usuario usr where ci.ID_Pac = rp.ID_Pac 
and usr.id_usuario =  rp.ID_Profesional and rp.ID_Cliente = $idUsuario and (ci.Estado=10 or ci.Estado=6) ORDER by ci.Fecha DESC";
$resultado = $mysqli->query($sql);
$sql1="SELECT ID_Pac FROM r_paciente  $where";

$contador=0;
?>
<?php include  '../../template/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="css/Bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.js"></script>
    <style>
        .inline{
            display:inline;
        }
    </style>
</head>
<body>
    <div class="row">
    <div class=""></div>
    <div class="container">

        <div class="row">
            <div class="col">
                <h2 class="component-title" style="text-align: center;">Citas</h2>
            </div>
        </div>
       <div class="row">
           <div class="col" style="text-align: -webkit-right">
               <div class="row table-responsive">
                   <table class="tabla table table-striped dt-responsive nowrsap display" id="mitabla" style="width: 100%;">
                       <thead>
                           <tr>
                               <th>Doctor</th>
                               <th>Fecha</th>
                               <th>Hora</th>
                               <th>Descripcion</th>
                               <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $resultado->fetch_assoc()) { $contador+=1; ?>
                                <tr>
                                    <td>
                                        <a href="/SocialHealth/components/profile/infoOdontologo.php?id=<?php echo $row['id_usuario']; ?>">
                                            <?=$row['nombre']," ",$row['apellido']; ?>
                                        </a>
                                    </td>
                                    <td><?=$row['Fecha']; ?></td>
                                    <td><?=$row['start'].'-'.$row['end']; ?></td>                                  
                                    <td><?=$row['Descripcion']; ?></td>
                                    <td><?=$row['Estado']; ?></td>
                                </tr>
                                <?php } if($contador <10){for($x=1;$x<=(10-$contador);$x++){ ?>
                                    <!-- <tr>
                                        <td>0</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr> -->
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
        <script>
                    $(document).ready(function(){
      tabla = $('#mitabla').DataTable({
         dom: 'Bfrtip',
         pageLength: 5,
         buttons: [
             {
                 extend: 'collection',
                 className: 'inline text-right button-none',
                 text: '<span class="text-primary"><i class="fas fa-ellipsis-v"></i></span> Opciones   ',
                 buttons: [
                    {
                        extend: 'collection',
                        className: 'inline',
                        text: '<i class="fas fa-stream"></i> Vistas',
                        buttons: [{
                            text:'<h6 class="dropdown-header">Vistas</h6>'
                        },{
                            text: '<i class="fas fa-table"></i> Clasico',
                            action:()=>{
                                window.location.href ='?viewmode=1';
                            }
                        },{
                            text: '<i class="fas fa-calendar"></i> Interactivo',
                            action:()=>{
                                window.location.href ='?viewmode=2';
                            }
                        }]
                    },
                    {
                        extend: 'colvis',
                        text:'<i class="far fa-eye"></i> Visibilidad'
                    },
                    {
                        extend: 'collection',
                        className: 'inline',
                        text: '<i class="fas fa-file-export"></i> Exportar',
                        buttons: [{
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel'
                        },{
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF'
                        },{
                            extend: 'copy',
                            text: '<i class="fas fa-file"></i> Copiar'
                        },{
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Imprimir'
                        }]
                    }
                ],
             }
         ],
         order: [[0, "dsc"]],
         language:{
             lengthMenu: "Mostrar _MENU_ por pagina",
             info: "Mostrando pagina _PAGE_ de _PAGES_",
             infoEmpty: "No hay registros disponibles",
             infoFiltered: "(filtrada de _MAX_ registros)",
             loadingRecords: "Cargando...",
             processing:     "Procesando...",
             search: "Buscar:",
             zeroRecords:    "No se encontraron registros coincidentes",
             paginate: {
                 next:       "Siguiente",
                 previous:   "Anterior"
             },					
         },
         Processing: true,
         //"ServerSide": true,
         //"ajax": "procesar.php"
     });
 });
        </script>
</body>
</html>
<?php include '../../template/footer.php'; ?>