<?php
    $errors[]=$_SESSION['notificacion'];
    $Msj=$_SESSION['notificacion'];
	function printErrors($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' style='color: #a94442; background-color: #f2dede; border-color: #ebccd1;' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
            echo "</ul>
            </div>";
		}
    }
    function printSucess($Msj){
		if(!empty($Msj))
		{
			echo "<div id='error' style='color: #a94442; background-color: #f2dede; border-color: #ebccd1;' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
				echo "<li>".$Msj."</li>";
            echo "</ul>
            </div>";
		}
	}
?>