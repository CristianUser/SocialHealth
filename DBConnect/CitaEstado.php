<?php
require '../login/funcs/conexion.php';
require 'DB_Usuario.php';
if(!empty($_POST))
{
    $id = $mysqli->real_escape_string($_POST['ID_Cita']);	
    $estado = $mysqli->real_escape_string($_POST['estado']);
    $go = $mysqli->real_escape_string($_POST['go']);
    
    if(estadoCita($id,$estado)){
       $mensaje="Guardado con exito";
    }else{
        $mensaje="Error al guardar";
    }
}
header("Location: ../Tablas/$go");
?>