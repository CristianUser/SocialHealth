<?php
	
	require ("../login/funcs/conexion.php");
	
	$id_region = $_POST['id_region'];
	
	$queryM = "SELECT `ID_Provincia`, `Nombre` FROM `provincias` WHERE ID_Region = '$id_region' ORDER BY Nombre";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value='0'>Selecciona...</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['ID_Provincia']."'>".$rowM['Nombre']."</option>";
	}
	
	echo $html;
?>		