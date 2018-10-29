
<?php 
require '../../functions/sesion.php';
include '../../template/header.php';?>
<br>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.4.2/js/all.js"></script> -->
    <title>Dashboard</title>
    <style>
      .inline{
        display: inline;
      }
      .block{
        display: block;
      }
      .inline-block{
        display: inline-block;
      }
      .none{
        display: none;
      }
      body{
        background-color: aliceblue;
      }
      .card{
        background-color: white;
        border-radius:0px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.16);
      }
      .card-footer{
        border-radius: 0px !important;
      }
      .huge {
          font-size: 40px;
      }
      .pull-right{
        float:right;
      }
      .pull-left{
        float: left;
      }
      .col-xs-3{
        width: 25%;
      }
      .col-xs-9{
        width:75%;
        float: left;
      }
      .bg-primary {
          background-color: #00a89e!important;
      }
      .text-primary{
          color: #00a89e!important;
      }
      .card .bg-dark{
        background-color: #2d3e50!important;
      }
      .card .text-dark{
        color: #2d3e50!important;
      }
      .badge-primary {
            color: #fff;
            background-color: #00a89e !important;
        }


    </style>
  </head>
  <body>
    <div class="container">
      <br>
      <!-- /.row -->
      <div class="row">
          <div class="col-lg-3 col-md-6">
              <div class="card text-white bg-primary">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-user-plus fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">26</div>
                              <div>Nuevos Pacientes</div>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer bg-light text-primary">
                      <span class="pull-left">Ver Detalles</span>
                      <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="card text-white bg-success">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-chart-line fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">12</div>
                              <div>Pacientes en total</div>
                          </div>
                      </div>
                  </div>
                  <a href="#">
                      <div class="card-footer bg-light text-success">
                          <span class="pull-left">Ver Detalles</span>
                          <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="card text-white bg-dark">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-tasks fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">124</div>
                              <div>Citas Pendientes</div>
                          </div>
                      </div>
                  </div>
                  <a href="#">
                      <div class="card-footer bg-light text-dark">
                          <span class="pull-left">Ver Detalles</span>
                          <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="card text-white bg-danger">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="far fa-chart-bar fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">13</div>
                              <div>Algo Mas</div>
                          </div>
                      </div>
                  </div>
                  <a href="#">
                      <div class="card-footer bg-light text-danger">
                          <span class="pull-left">Ver Detalles</span>
                          <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
      <!-- /.row -->
      <!-- /.row -->
      <br>
      <div class="row">
        <div class="col-8">
          <div class="card">
            <div class="card-header">Lista de Tareas</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">Notificaciones</div>
                <div class="card-body">
                    <ul class="list-group-flush" style="padding-left: 0px;">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Mensajes Nuevos
                          <span class="badge badge-primary badge-pill">14</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Citas Atrasadas
                          <span class="badge badge-primary badge-pill">2</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Visitas
                          <span class="badge badge-primary badge-pill">25</span>
                        </li>
                      </ul>
                </div>
              </div>
        </div>
      </div>
      <!-- /.row -->
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
  </body>
</html>
<?php include '../../template/footer.php';?>