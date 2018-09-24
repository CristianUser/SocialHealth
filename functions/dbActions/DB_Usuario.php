<?php
//require_once '../../connection.php';

/*
function isEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
        } else {
        return false;
    }
}*/
function agregarRPaciente($idpac,$idpro){
    global $mysqli;
    
    $sql = "SELECT MAX(ID_Pac) FROM `r_paciente`";
    $resultado = $mysqli->query($sql);
    $r=$resultado->fetch_assoc();
    $idr=$r['MAX(ID_Pac)'];
    $idr+=1;

    $stmt = $mysqli->prepare("INSERT INTO `r_paciente`(`ID_Pac`, `ID_Cliente`, `ID_Profesional`) VALUES (?,?,?)");
    $stmt->bind_param('sss', $idr, $idpac, $idpro);
    
    if ($stmt->execute()){
        return true;
        } else {
        return false;	
    }
}
function estadoCita($id,$estado){
    global $mysqli;
    
    $stmt = $mysqli->prepare("UPDATE `citas` SET `Estado`= ? WHERE ID_Cita= ?");
    $stmt->bind_param('ss', $estado, $id);
    
    if ($stmt->execute()){
        return true;
        } else {
        return false;	
    }
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
function registraCita($id,$fecha,$descripcion,$hora){
		
    global $mysqli;
    $estado="Pendiente";
    $stmt = $mysqli->prepare("INSERT INTO `citas`( `ID_Pac`, `Estado`, `Fecha`, `Hora`, `Descripcion`) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss',$id,$estado,$fecha,$hora,$descripcion);
    
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