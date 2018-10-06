<?php
include '../../../functions/connection.php';
include '../../../functions/funcs.php';
$usuario = $_GET["username"];
if(usuarioExiste($usuario))
{
    echo "El nombre de usuario $usuario ya existe";
}else{
    echo "El nombre de usuario $usuario esta disponible";
}
?>