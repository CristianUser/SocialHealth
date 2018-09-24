<?php
require '../../functions/connection.php';
require '../../functions/sesion.php';

if($tipo==1){
  include 'citas_pac.php';
}elseif($tipo==2){
  include 'citas_pro.php';
}

?>