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
function RPacienteExists($idpac,$idpro){
    global $mysqli;
		
    $stmt = $mysqli->prepare("SELECT * FROM r_paciente rp WHERE rp.ID_Cliente=? and rp.ID_Profesional=? LIMIT 1");
    $stmt->bind_param("ss", $idpac,$idpro);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;
    $stmt->close();
    
    if ($num > 0){
        return true;
        } else {
        return false;	
    }
}
function addRPaciente($idpac,$idpro){
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
function editAppointment($id,$status,$description){
    global $mysqli;
    
    $stmt = $mysqli->prepare("UPDATE `citas` SET `Estado`= ? ,`Descripcion`= ? WHERE ID_Cita= ?");
    $stmt->bind_param('sss', $status,$description, $id);
    
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
function registraCita($id,$fecha,$descripcion,$horaInicio,$horaFin){
		
    global $mysqli;
    $estado=10;
    $stmt = $mysqli->prepare("INSERT INTO `citas`(`ID_Pac`, `Estado`, `Fecha`, `horaInicio`, `horaFin`, `Descripcion`) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param('ssssss',$id,$estado,$fecha,$horaInicio,$horaFin,$descripcion);
    
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