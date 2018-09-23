<?php 
 require_once '../connection.php';
 $sql = "SELECT MAX(ID_Pac) FROM `r_paciente`";
    $resultado = $mysqli->query($sql);
    $r=$resultado->fetch_assoc();
    $idr=$r['MAX(ID_Pac)'];
    $idr+=1;
    echo $idr;
 ?>