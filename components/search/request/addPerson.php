<?php
require '../../../functions/connection.php';
require '../../../functions/dbActions/DB_Usuario.php';
$idpac=$_POST['idpac'];
$iddoc=$_POST['iddoc'];
if(RPacienteExists($idpac,$iddoc)){
    $array['exist']=true;
}else{
    $array['success']=addRPaciente($idpac,$iddoc);
}
    header("Content-Type:application/json");
    echo json_encode($array);
?>