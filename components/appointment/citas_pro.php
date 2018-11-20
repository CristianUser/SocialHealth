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
and usr.id_usuario =  rp.ID_Cliente and rp.ID_Profesional = $idUsuario and (ci.Estado!=7) ORDER by ci.Fecha DESC";
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
            </div>
        </div>
       <div class="row">
           <div class="col">
               <div class="row table-responsive" style="text-align: end;">
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
                                <tr id="<?=$row['ID_Cita']; ?>">
                                    <td>
                                        <a href="/SocialHealth/components/profile/infoPaciente.php?id=<?=$row['id_usuario']; ?>">
                                            <?=$row['nombre']," ",$row['apellido']; ?>
                                        </a>
                                    </td>
                                    <td><?=$row['Fecha']; ?></td>
                                    <td><?=$row['horaInicio']; ?></td>                                  
                                    <td><?=$row['Descripcion']; ?></td>
                                    <td><?=$estados[$row['Estado']]; ?></td>
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
                    
                    <form name='form'>
                        <input type="hidden" id="idCita" value="">
                        <div class="row">
                            <div class="col">
                                <h6>Proceso Realizado</h6>
                                <select class="form-control" name="select" id="">
                                    <option value="">Selecciona</option>
                                    <option value="Extraccion Dental">Extraccion Dental</option>
                                    <option value="Revision Bucal">Revision</option>
                                    <option value="Revision Bucal">Limpieza Bucal</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col">
                                <button class="btn btn-cmj" value="11">Posponer</button>
                            </div>
                            <div class="col">
                                <button id="btnComplete" class="btn btn-cmj" value="7">Completar</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div id="alertS" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p>Cambio Realizado!</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="alertD" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>Se ha producido un error!</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
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
     $('#launchModal').click(()=>{
         console.log();
        //  $('#appModal').modal('toggle')
     });
 });	
 var idpac;
    selectElement=(element)=>{
        $('#appModal').modal('toggle')
        $('#idCita').val(element.parentNode.parentNode.id);
        console.log(element.parentNode.parentNode.id);
        idpac=element.parentNode.parentNode.id;
    };
    editAppointment = (status)=>{
        let parametros = {
            id:idpac,
            token:token,
            status:status,
            description:form.select.value
        };
        $.ajax({
            url : 'request/editAppointment.php',
            data : parametros,
            type : 'POST',
            success : function(res) {
                console.log(res);
                if(res=='Confirmado'){
                    $('#alertS').show();
                    setTimeout(function(){ window.location.reload(false); },1000);
                }else{
                    $('#alertD').show();
                }
            },
            error : function(xhr, status) {
                console.log('Disculpe, existió un problema');
            },
            complete : function(xhr, status) {
                console.log('Petición realizada');
            }
        });
    };
    $("#btnComplete").click(function (e) { 
        e.preventDefault();
        editAppointment(7);
    });
    $(document).ready(function () {
        $('#alertD').hide();
        $('#alertS').hide();
    });
    </script>
</body>
</html>
<?php include '../../template/footer.php'; ?>