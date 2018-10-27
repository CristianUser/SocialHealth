<?php
require './connection.php';
$iddoc=4;
$idpac=6;
$sql="SELECT ID_Pac FROM r_paciente rp WHERE rp.ID_Cliente=$idpac and rp.ID_Profesional=$iddoc";
$resultado = $mysqli->query($sql);
$idres = $resultado->fetch_assoc()['ID_Pac'];
if(!$idres){
    die ('Error en la peticion');
}
echo 'klk';

?>