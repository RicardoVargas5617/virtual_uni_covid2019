<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$codigo = $_GET["codigo"];
	$val = $_GET["val"];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);
	$tipo = 'V';

	$vsql = "call zyz_CAMantenedorPostulante (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $postulante ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '1900-01-01',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";	
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " ". $val .",";
	$vsql = $vsql . " '',";	
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	#$rs=mysqli_query($cnzet, strtoupper($vsql));
	$rs=mysqli_query($cnzet, $vsql);
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se grabaron la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>