<?php
require '../../../functions/connection.php';
$idpac=$_GET['idpac'];
$iddoc=$_GET['iddoc'];
$sql = "SELECT ci.ID_Cita as id, ci.Fecha , ci.Estado as status, ci.horaInicio hora, ci.Descripcion as description
FROM citas ci , r_paciente rp where ci.ID_Pac = rp.ID_Pac and rp.ID_Cliente = $idpac  and rp.ID_Profesional= $iddoc and ci.Estado = 7 ORDER by ci.Fecha DESC";
$resultado = $mysqli->query($sql);
$json='[';
while($row = $resultado->fetch_assoc()){
    $date=date_create_from_format('Y-m-d H:i:s',$row['Fecha'].' '.$row['hora']);

    $row['date']=$date->format('d/m/Y - H:i A');
    unset($row['hora']);
    unset($row['Fecha']);
    $json.=json_encode($row);
    $json.=',';
}
$json=substr($json,0,strlen($json)-1);
$json.=']';
header('Content-Type: application/json');
echo $json;

?>