<?php
require '../../../functions/connection.php';
require '../../../functions/dbActions/DB_Usuario.php';
session_start();

$id=$_POST['id'];
$status=$_POST['status'];
$description=$_POST['description'];
if($_SESSION['token']==$_POST['token']){

    if(editAppointment($id, $status, $description)){
        echo "Confirmado";
    }else{
        echo "Error";
    }
}else{
    echo 'Error de seguridad';
}

?>