<?php
include '../../functions/sesionPro.php';
include '../../functions/dbActions/DB_Usuario.php';

$sql = "SELECT * FROM estados";
$resultado = $mysqli->query($sql);
$estados;
while($row = $resultado->fetch_assoc()){
 $estados[$row['id_estado']]=$row['nombre'];
};

$where="WHERE rp.ID_Profesional = $idUsuario";
$sql = "SELECT ci.ID_Cita, ci.Fecha, ci.Estado, ci.horaInicio, ci.Descripcion, usr.id_usuario, usr.nombre, usr.apellido 
FROM citas ci , r_paciente rp ,usuario usr where ci.ID_Pac = rp.ID_Pac 
and usr.id_usuario =  rp.ID_Cliente and rp.ID_Profesional = $idUsuario and (ci.Estado=10 or ci.Estado=6) ORDER by ci.Fecha DESC";
$resultado = $mysqli->query($sql);
$sql1="SELECT ID_Pac FROM r_paciente  $where";

$contador=0;

?>
<?php include '../../template/header.php'; ?>
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
                <h2 class="component-title">Citas</h2>
                <div class="dropdown text-right">
                    <button class="button-none" style="padding-left: 10px;padding-right: 10px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-primary"><i class="fas fa-ellipsis-v"></i></span>
                    </button>
                    <div id="opciones" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header">Vistas</h6>
                        <a class="dropdown-item" href="?viewmode=1">Clasica</a>
                        <a class="dropdown-item" href="?viewmode=2">Interactiva</a>
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
                               <th>Paciente</th>
                               <th>Fecha</th>
                               <th>Hora</th>
                               <th>Descripcion</th>
                               <th>Estado</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $resultado->fetch_assoc()) { $contador+=1; ?>
                                <tr id="<?php echo $row['ID_Cita']; ?>">
                                    <td>
                                        <a href="/SocialHealth/components/profile/infoPaciente.php?id=<?php echo $row['id_usuario']; ?>">
                                            <?php echo $row['nombre']," ",$row['apellido']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $row['Fecha']; ?></td>
                                    <td><?php echo $row['horaInicio']; ?></td>                                  
                                    <td><?php echo $row['Descripcion']; ?></td>
                                    <td><?php echo $estados[$row['Estado']]; ?></td>
                                    <td>
                                        <div id="launchModal" onclick="selectElement(this)">
                                            <span class="text-primary"><i class="fas fa-check"></i></span>
                                        </div>
                                    </td>
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
    <div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="appModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel">Completar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form>
                        <input type="hidden" id="idCita" value="">
                        <div class="row text-center">
                            <div class="col">
                                <button class="btn btn-cmj" value="7">Completar</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-cmj" value="11">Posponer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-cmj">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <script type="text/Javascript">
        $(document).ready(function(){
     $('#mitabla').DataTable({
         "dom": 'Bfrtip',
         pageLength: 5,
         buttons: [
             {
                 extend: 'collection',
                 className: 'inline',
                 text: '<i class="fas fa-file-export"></i> Exportar',
                 buttons: [ 'excel','pdf',{
                     extend: 'copy',
                     text: 'Copiar'
                 },{
                     extend: 'print',
                     text: 'Imprimir'
                 },{
                     extend: 'colvis',
                     text:'Visibilidad'
                 }]
             }
         ],
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
     $('#launchModal').click(()=>{
         console.log();
        //  $('#appModal').modal('toggle')
     });
 });	
    selectElement=(element)=>{
        $('#appModal').modal('toggle')
        $('#idCita').val(element.parentNode.parentNode.id);
        console.log(element.parentNode.parentNode.id);
    };
    editAppointment = ()=>{
        let parametros = {
            id:id,
            token:token,
            status:status

        };
        $.ajax({
            url : 'request/getPersona.php',
            data : parametros,
            type : 'POST',
            success : function(req) {
            },
            error : function(xhr, status) {
                console.log('Disculpe, existió un problema');
            },
            complete : function(xhr, status) {
                console.log('Petición realizada');
            }
        });
    };
    </script>
</body>
</html>
<?php include '../../template/footer.php'; ?>