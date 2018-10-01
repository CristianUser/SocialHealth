<?php
    include "../../../functions/connection.php";
    session_start();
    $idUsuario = $_SESSION['id_usuario'];
    $token = $_SESSION['token'];
    $pToken=$_GET["token"];
    $idP=$_GET["id"];
    if($token==$pToken){
        $sqlP="SELECT u.nombre, u.apellido, u.id_usuario FROM usuario u WHERE u.id_usuario = $idP";
        $personaP = $mysqli->query($sqlP);
        $resultP=$personaP->fetch_assoc();
        $myJSON = json_encode($resultP);
        $img_fileP="../../../private/files/$idP/perfil.png";
        if(!file_exists($img_fileP)){
            $img_fileP = "../../../assets/images/perfil.jpg";
        }
        $imgDataP = base64_encode(file_get_contents($img_fileP));
        $perfilP = 'data: '.mime_content_type($img_fileP).';base64,'.$imgDataP;
        //header('Content-Type: application/json');
        echo substr($myJSON, 0, -1),',"foto":"',$perfilP,'"}';
}
?>
