<?php
$id=$_POST['id'];
//$archivo=$_FILES['upload'];
$id_insert=$id;
$errors = array();
if($_FILES["file"]["error"]>0){
    $errors[]= "error al cargar archivo";
}else{
    $permitidos = array("image/gif","image/png","image/jpeg","image/jpg",
    "application/pdf", "application/doc", "application/docx", "application/rtf",
     "application/txt", "application/odf", "application/msword","plain/text");
    $limite_kb = 20000;

    if(in_array($_FILES["file"]["type"], $permitidos) && $_FILES["file"]["size"] <= ($limite_kb * 1024)){
        $ruta = '../../private/files/'.$id_insert.'/documents/';
        $archivo = $ruta.$_FILES["file"]["name"];

        if(!file_exists($ruta)){
            mkdir($ruta);
        }
            $resultado = @move_uploaded_file($_FILES["file"]["tmp_name"],$archivo);
            if($resultado){
                echo "Archivo guardado";
            }else{
                echo "Error al guardar";
            }     
    }else{
        echo "Archivo no permitido";
    }
}
?>