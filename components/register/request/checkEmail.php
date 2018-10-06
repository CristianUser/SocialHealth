<?php
include '../../../functions/connection.php';
include '../../../functions/funcs.php';
$email = $_GET["email"];
if(emailExiste($email))
{
    echo 'Usado';
}else{
    echo 'Disponible';
}
?>