<?php
require 'connection.php';
$userId=$_GET['id'];
$sql = "SELECT usr.nombre as name, usr.apellido as lastname FROM usuario usr INNER JOIN datos_cliente dp 
ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario in 
(SELECT ID_Cliente FROM r_paciente WHERE ID_Profesional = $userId)";
$resultado = $mysqli->query($sql);
// print_r($resultado);
while($row = $resultado->fetch_assoc()){
 print_r($row);
};
// print_r(array_keys($array)[1]);
?>