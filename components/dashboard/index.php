
<?php 
require '../../functions/sesion.php';
include '../../template/header.php';
if($tipo==1){
  include 'paciente.html';
}elseif($tipo==2){
  include 'doctor.html';
}
 include '../../template/footer.php';?>