<?php
	require_once '../connection.php';
	require 'DB_Usuario.php';
if(!empty($_POST))
{
    $fecha = $mysqli->real_escape_string($_POST['fecha']);	
	$horaInicio = $mysqli->real_escape_string($_POST['horaInicio']);
	$horaFin = $mysqli->real_escape_string($_POST['horaFin']);
    $descripcion = $mysqli->real_escape_string($_POST['descripcion']);	
	$id = $mysqli->real_escape_string($_POST['ID_Pac']);	
    if(registraCita($id,$fecha,$descripcion,$horaInicio,$horaFin)){
       $mensaje="Guardado con exito";
    }else{
        $mensaje="Error al guardar";
    }
}

?>
	