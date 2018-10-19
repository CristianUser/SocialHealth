<?php
	require_once("../lib/Tinify/Exception.php");
	require_once("../lib/Tinify/ResultMeta.php");
	require_once("../lib/Tinify/Result.php");
	require_once("../lib/Tinify/Source.php");
	require_once("../lib/Tinify/Client.php");
	require_once("../lib/Tinify.php");
	\Tinify\setKey("oDjQb07lztuEpfTOajRaBXpUJkfqMiaL");
	session_start();
	$idReq=$_POST['id'];
	$id=$_SESSION['id_usuario'];
	$tokenReq=$_POST['token'];
	$token=$_SESSION['token'];
	if($id==$idReq){
		if($token==$tokenReq){
			define('UPLOAD_DIR', '../../private/files/'.$idReq.'/');
			$img = $_POST['img'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			//$file = UPLOAD_DIR . uniqid() . '.png';
			$file = UPLOAD_DIR .'perfil.png';
			if(!file_exists(UPLOAD_DIR)){
				mkdir(UPLOAD_DIR);
			}
			$resultData = \Tinify\fromBuffer($data)->toBuffer();
			$success = file_put_contents($file, $resultData);
			//print $success ? $file : 'Unable to save the file.';
		}
	}
	if($success){
		echo'Correcto';
	}else{
		echo 'Error';

	}
?>