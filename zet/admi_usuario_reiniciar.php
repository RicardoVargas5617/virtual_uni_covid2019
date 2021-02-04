<?php
	session_start();
	if (!isset($_SESSION["usuario"]) or  $_SERVER['HTTP_REFERER'] == "")
	{
		header("location:noautorizado.php");
	}
	include_once "sessiones.php";
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$per = substr($codigo,0,8);
	$tra = substr($codigo,8,8);

	$vsql = "call zyz_Man_Usuario (";
	$vsql = $vsql . " '". $per ."',";
	$vsql = $vsql . " '". $tra ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";	
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '1900-01-01',";
	$vsql = $vsql . " '1',";
	$vsql = $vsql . " '2',";
	$vsql = $vsql . " '3',";
	$vsql = $vsql . " '4',";
	$vsql = $vsql . " '5',";
	$vsql = $vsql . " '6',";
	$vsql = $vsql . " '7',";
	$vsql = $vsql . " '8',";
	$vsql = $vsql . " '9',";
	$vsql = $vsql . " 'R')";
	#echo $vsql;
	#exit;
		
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));

	mysqli_close($cnzet);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se elimino la informacion ingresada'));
			}
	else{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			}
?>