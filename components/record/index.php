<?php
require '../../functions/connection.php';
require '../../functions/sesion.php';

if($tipo==1){
  include 'historial_pac.php';
}elseif($tipo==2){
  include 'historial_pro.php';
}

?>