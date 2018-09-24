<?php
require '../../functions/connection.php';
require '../../functions/sesion.php';

if($tipo==1){
  include 'odontologos.php';
}elseif($tipo==2){
  include 'pacientes.php';
}

?>