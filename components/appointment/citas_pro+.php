<?php 
include '../../functions/sesionPro.php';
include '../../template/header.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='/SocialHealth/public/css/fullcalendar.min.css' rel='stylesheet' />
<link href='/SocialHealth/public/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link rel="stylesheet" href="/SocialHealth/public/css/styleEvent.css">
<script src='/SocialHealth/public/lib/moment.min.js'></script>
<script src='/SocialHealth/public/js/fullcalendar.min.js'></script>
<script src='/SocialHealth/public/js/theme-chooser.js'></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
<!-- <script src="https://use.fontawesome.com/releases/v5.4.1/js/all.js"></script> -->
<script src="/SocialHealth/public/lib/jquery-ui.min.js"></script>
<script src="/SocialHealth/public/locale/es-us.js"></script>
<script>
    let doctorName='<?php echo ''?>',
    doctorId=id,
    userName="",
    userId=id;
</script>
<script src="./js/scriptEvents.js"></script>
<style>

        body {
          margin: 0;
          padding: 0;
          font-size: 14px;
        }
      
        #top,
        #calendar.fc-unthemed {
          font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        }
      
        #top {
          background: #eee;
          border-bottom: 1px solid #ddd;
          padding: 0 10px;
          line-height: 40px;
          font-size: 12px;
          color: #000;
        }
      
        .left { float: left }
        .right { float: right }
        .clear { clear: both }
      
        #calendar {
          max-width: 900px;
          margin: 40px auto;
          padding: 0 10px;
        }
        #loading {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
        }
      
      </style>
</head>
<body>
  <br>
  <div class="container" style="padding-top: 1px;">

    <div id='loading'>loading...</div>
    <div>
      <h4>Mis Citas</h4>
      <div class="dropdown text-right">
                    <button class="button-none" style="padding-left: 10px;padding-right: 10px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-primary"><i class="fas fa-ellipsis-v"></i></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header">Vistas</h6>
                        <a class="dropdown-item" href="?viewmode=1">Clasica</a>
                        <a class="dropdown-item" href="?viewmode=2">Interactiva</a>
                    </div>
                </div>
    </div>
    <div id='calendar' style="margin-top: 10px;"></div>
    
    <div class="modal fade" id="modalCitar" tabindex="-1" role="dialog" aria-labelledby="modalCitarTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCitarTitle">Resumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <h6>Descripcion</h6>
              <div class="Resumen"></div>
              <select class="form-control" name="" id="">
                  <option value="">Seleciona un Paciente </option>
                  <?php
                  $sql = "SELECT usr.id_usuario as userId, usr.nombre as name, usr.apellido as lastname FROM usuario usr INNER JOIN datos_cliente dp 
                  ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario in 
                  (SELECT ID_Cliente FROM r_paciente WHERE ID_Profesional = 4)";
                  $resultado = $mysqli->query($sql);
                  while($row = $resultado->fetch_assoc()){?>
                   <option value="<?=$row['userId']?>"><?=$row['name'].' '.$row['lastname']?></option>
                   <?php
                  };
                  ?>
              </select>
              <br>
              <div class="form-group">
                <textarea class="form-control Descripcion" id="message-text" placeholder="Mensaje"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
            <button type="button" class="btn btn-primary active" data-dismiss="modal" id="addBtn">Confirmar Cita</button>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  </body>
</html>
<?php include '../../template/footer.php';?>
