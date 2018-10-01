<?php
    include "../../../functions/connection.php";
    session_start();
    $idUsuario = $_SESSION['id_usuario'];
    $token = $_SESSION['token'];
    $pToken=$_GET["token"];
    ///consultamos a la base
    $id=$_GET["id"];
    
    if($token==$pToken){

        $where="WHERE ID_Profesional = $id";
        $sql = "SELECT * FROM usuario usr INNER JOIN datos_cliente dp 
        ON usr.id_usuario = dp.ID_Usuario and usr.id_usuario in 
        (SELECT ID_Cliente FROM r_paciente $where)";
        $ejecutar = $mysqli->query($sql);
        
        while($fila = $ejecutar->fetch_array()) : 
            $userID=$fila['id_usuario'];
            $img_file="../../../private/files/$userID/perfil.png";
            if(!file_exists($img_file)){
            $img_file = "../../../assets/images/perfil.jpg";
            }
            $imgData = base64_encode(file_get_contents($img_file));
            // Format the image SRC:  data:{mime};base64,{data};
            $perfil = 'data: '.mime_content_type($img_file).';base64,'.$imgData;
?>
    <li value="<?php echo $fila['id_usuario']?>" class="list-group-item"><div class="incoming_msg_img"> <img src="<?php echo $perfil?>" alt=""> 
    </div><p><?php echo $fila['nombre']," ",$fila['apellido']?></p></li>
	
<?php    endwhile; 
    }
?>