<?php
require_once './connection.php';
require '../../SocialHealth/functions/dbActions/DB_Usuario.php';
if(!empty($_POST))
{
$fecha = $mysqli->real_escape_string($_POST['fecha']);	
$horaInicio = $mysqli->real_escape_string($_POST['horaInicio']);
$horaFin = $mysqli->real_escape_string($_POST['horaFin']);
$descripcion = $mysqli->real_escape_string($_POST['descripcion']);	
$iddoc=$mysqli->real_escape_string($_POST['doctorId']);;
$idpac=$mysqli->real_escape_string($_POST['userId']);;

$sql="SELECT ID_Pac FROM r_paciente rp WHERE rp.ID_Cliente=$idpac and rp.ID_Profesional=$iddoc";
$resultado = $mysqli->query($sql);

$id = $resultado->fetch_assoc()['ID_Pac'];
if(!$id){
    die ('Error en la peticion');
}

if(registraCita($id,$fecha,$descripcion,$horaInicio,$horaFin)){
   echo "Guardado con exito";
}else{
    echo "Error al guardar";
}
}else
{
    die ('Faltan Parametros');
}

?>