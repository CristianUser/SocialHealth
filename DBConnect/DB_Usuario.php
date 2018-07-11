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

function registraDatosPac($id, $seguro, $nss, $nacimiento, $sexo, $telefono, $cedula, $provincia, $direccion){
		
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO `datos_cliente`(`ID_Usuario`, `ID_Provincia`, `Nacimiento`, `NSS`, `Cedula`, `Direccion`, `Sexo`, `Telefono`, `ID_Seguro`) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssss',$id, $provincia, $nacimiento, $nss, $cedula,  $direccion, $sexo, $telefono, $seguro);
    
    if ($stmt->execute()){
        return true;
        } else {
        return false;	
    }		
}
function registraDatosPro($id, $especialidades, $nacimiento, $sexo, $telefono, $cedula, $provincia, $direccion){

    //$arrayEspecialidades = null;

    
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO `datos_profesional`(`ID_Usuario`, `ID_Provincia`, `Nacimiento`, `Direccion`, `Sexo`, `Telefono`, `Cedula`) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('iisssss',$id, $provincia, $nacimiento, $direccion , $sexo,  $telefono, $cedula);
    
    if ($stmt->execute()){
        $num_array= count($especialidades);
        $contador=0;
        if($num_array>0){
            foreach ($especialidades as $key => $value) {
                if ($contador != $num_array-1){
                    //$arrayEspecialidades .= $value.' ';
                    $sql="INSERT INTO `r_especialidades`(`ID_Especialidad`, `id_usuario`) VALUES ($value,$id)";
                    $mysqli ->query($sql);
                $contador++;
                } else {
                //$arrayEspecialidades .= $value;
                $sql="INSERT INTO `r_especialidades`(`ID_Especialidad`, `id_usuario`) VALUES ($value,$id)";$mysqli ->query($sql);
                }
            }
        }
        return true;
        } else {
        return false;	
    }		
}

?>