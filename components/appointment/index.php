<?php
require '../../functions/connection.php';
require '../../functions/sesion.php';
if(!empty($_GET)){
  $viewmode=$_GET['viewmode'];
}else{
  $viewmode=1;
}
if($tipo==1){
  include 'citas_pac.php';
}elseif($tipo==2){
  if($viewmode==1){
    include 'citas_pro.php';
  }elseif($viewmode==2){
    include 'citas_pro+.php';
  }
}

?>