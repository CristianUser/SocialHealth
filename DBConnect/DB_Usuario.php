<?php
require '../login/funcs/conexion.php';
function isEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
        } else {
        return false;
    }
}

function saveData($id, $tipo){

}

function registraDatos1($id, $seguro, $nss, $nacimiento, $sexo, $telefono, $cedula, $provincia, $direccion){
		
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO `datos_cliente`(`ID_Usuario`, `ID_Provincia`, `Nacimiento`, `NSS`, `Cedula`, `Direccion`, `Sexo`, `Telefono`, `ID_Seguro`) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssss',$id, $provincia, $nacimiento, $nss, $cedula,  $direccion, $sexo, $telefono, $seguro);
    
    if ($stmt->execute()){
        return 1;
        } else {
        return 0;	
    }		
}

?>