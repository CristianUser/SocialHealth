<?php
require '../../../functions/connection.php';

$sql = "SELECT COUNT(rp.ID_Pac) as n FROM r_paciente rp WHERE rp.ID_Profesional=4";
$resultado = $mysqli->query($sql);
$result = $resultado->fetch_assoc()['n'];
//echo $result;
$array['patients']=$result;

//unset($resultado);
$sql="SELECT COUNT(ci.ID_Cita) as n FROM citas ci , r_paciente rp WHERE ci.ID_Pac= rp.ID_Pac and rp.ID_Profesional=4 and ci.Estado=10";
$resultado = $mysqli->query($sql);
$result = $resultado->fetch_assoc()['n'];
//echo $result;
$array['appointments']=$result;
// $json='[';
$json=json_encode($array);
// $json.=']';
header('Content-Type: application/json');
echo $json;
?>