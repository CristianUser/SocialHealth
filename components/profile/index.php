<?php
require '../../functions/connection.php';
require '../../functions/sesion.php';

if($tipo==1){
  include 'micuenta_Pac.php';
}elseif($tipo==2){
  include 'micuenta_Pro.php';
}

?>