<?php
$id=$_POST['id'];
$archivo=$_FILES['upload'];
$url=$_POST['url'];
$id_insert=$id;
if($_FILES["upload"]["error"]>0){
    echo "error al cargar archivo";
}else{
    $permitidos = array("image/gif","image/png","image/jpeg","image/jpg","application/pdf");
    $limite_kb = 20000;

    if(in_array($_FILES["upload"]["type"], $permitidos) && $_FILES["upload"]["size"] <= ($limite_kb * 1024)){
        $ruta = '../login/files/'.$id_insert.'/';
        $archivo = $ruta.'perfil.png';

        if(!file_exists($ruta)){
            mkdir($ruta);
        }
            $resultado = @move_uploaded_file($_FILES["upload"]["tmp_name"],$archivo);
            if($resultado){
                echo "Archivo guardado";
            }else{
                echo "Error al guardar";
            }     
    }else{
        echo "Archivo no permitido";
    }
}
//header("Location: $url");
?>