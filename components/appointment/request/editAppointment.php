<?php
require '../../../functions/connection.php';

$sql = "SELECT * FROM estados";
$resultado = $mysqli->query($sql);
$array;
while($row = $resultado->fetch_assoc()){
 //print_r($row);
 $array[$row['id_estado']]=$row['nombre'];
};
print_r(array_keys($array)[1]);

?>