<?php
require_once("dbcontroller.php");
require_once("pagination.class.php");
$db_handle = new DBController();
$perPage = new PerPage();

if(!empty($_GET["keyword"])){
	$keyword=$_GET["keyword"];
	$sql = "SELECT usr.id_usuario, usr.usuario, CONCAT(usr.nombre,' ',usr.apellido) as nombre, usr.correo, dp.ID_Provincia, dp.Telefono 
	FROM usuario usr, datos_profesional dp WHERE usr.id_tipo=2 and usr.id_usuario=dp.ID_Usuario and nombre LIKE '%$keyword%'";
}else{
	$sql = "SELECT usr.id_usuario, usr.usuario, CONCAT(usr.nombre,' ',usr.apellido) as nombre, usr.correo, dp.ID_Provincia, dp.Telefono 
	FROM usuario usr, datos_profesional dp WHERE usr.id_tipo=2 and usr.id_usuario=dp.ID_Usuario";
}
$paginationlink = "request/getresult.php?page=";	
//$pagination_setting = $_GET["pagination_setting"];
$pagination_setting = "all-links";
				
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
$faq = $db_handle->runQuery($query);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $db_handle->numRows($sql);
}

if($pagination_setting == "prev-next") {
	$perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting);	
} else {
	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	
}


$output = '<div class="row">';
foreach($faq as $k=>$v) {
 //$output .= '<div class="question"><input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />' . $faq[$k]["nombre"] . '</div>';
 //$output .= '<div class="answer">' . $faq[$k]["apellido"] . '</div>';
 $img_file2 = "../../../private/files/".$faq[$k]["id_usuario"]."/perfil.png";
if(!file_exists($img_file2)){
  $img_file2 = "../../../assets/images/perfil.jpg";
}

// A few settings
//$img_file = 'raju.jpg';

// Read image path, convert to base64 encoding
$imgData2 = base64_encode(file_get_contents($img_file2));

// Format the image SRC:  data:{mime};base64,{data};
$perfil = 'data: '.mime_content_type($img_file2).';base64,'.$imgData2;
 $output .= '
 <div class="col">
 <div class="card" style="">
 <input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />
 <img class="card-img-top" src="'.$perfil.'" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">'.$faq[$k]["nombre"].'</h5>
    <h6 class="card-subtitle mb-2 text-muted">Odontologo</h6>
    <p class="card-text"></p>
    <a href="/SocialHealth/components/profile/infoOdontologo.php?id='.$faq[$k]["id_usuario"].'" class="card-link">Ver Perfil</a>
    <a href="#" class="card-link btn btn-cmj text-light" onclick="(addPerson('.$faq[$k]["id_usuario"].'))">Agregar</a>
  </div>
</div>
</div>
 
 ';

}
if(!empty($perpageresult)) {
$output .= '</div><br><div id="pagination col-12">' . $perpageresult . '</div>';
}
print $output;
?>
