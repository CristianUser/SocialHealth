<?php
include '../../functions/sesionPro.php';
include '../../functions/dbActions/DB_Usuario.php';
$where="WHERE rp.ID_Profesional = $idUsuario";
$sql = "SELECT ci.ID_Cita, ci.Fecha, ci.Estado, ci.horaInicio Hora, ci.Descripcion, usr.id_usuario, usr.nombre, usr.apellido 
FROM citas ci , r_paciente rp ,usuario usr where ci.ID_Pac = rp.ID_Pac 
and usr.id_usuario =  rp.ID_Cliente and rp.ID_Profesional = $idUsuario and ci.Estado!=5";
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.js"></script>
</head>
<body>
    ><div class="row">
    <div class=""></div>
    <div class="container">

        <div class="row">
            <div class="col">
                <h2 class="component-title" style="text-align: center;">Historial</h2>
            </div>
        </div>
       <div class="row">
           <div class="col">
               <div class="row table-responsive text-right">
                   <table class="tabla table table-striped dt-responsive nowrsap display" id="mitabla" style="width: 100%;">
                       <thead>
                           <tr>
                               <th>Paciente</th>
                               <th>Fecha</th>
                               <th>Hora</th>
                               <th>Descripcion</th>
                               <th>Estado</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $idsel; while($row = $resultado->fetch_assoc()) { $contador+=1; ?>
                                <tr>
                                    <td>
                                        <a href="/SocialHealth/components/profile/infoPaciente.php?id=<?php echo $row['id_usuario']; ?>">
                                            <?php echo $row['nombre']," ",$row['apellido']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $row['Fecha']; ?></td>
                                    <td><?php echo $row['Hora']; ?></td>                                  
                                    <td><?php echo $row['Descripcion']; ?></td>
                                    <td><?php echo $row['Estado']; ?></td>
                                    <td>
                                        <img onclick="<?php $idsel = $row['ID_Cita'];?>" style="width: 25px;" src="icons/Close.png" alt="" data-toggle="modal" data-target="#exampleModal">
                                    </td>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Completar cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseas Eliminarlo?</p>
                </div>
                <div class="modal-footer">
                    <form role="form" method="POST" action="../DBConnect/CitaEstado.php">
                        <input type="hidden" name="ID_Cita" id="ID_Cita" value="<?php echo $idsel;?>">
                        <input type="hidden" name="estado" id="estado" value="5">
                        <input type="hidden" name="go" value="historial_pro.php">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/Javascript">
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
     });
	});	
    </script>
</body>
</html>
<?php include '../../template/footer.php'; ?>