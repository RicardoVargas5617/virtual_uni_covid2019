<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");

	##if (isset($_POST['chkConforme'])) 
	#	{
	#		$conforme = 1;
	#	}
	#else
	#	{
	#		$conforme = 0;
	#	}
	
	$per = $_POST['codigo'];
	$conforme = $_POST['chkConforme'];
	$tipito = 'U';
	
	$vsql = "call zyz_CAConstancia (";	
	$vsql = $vsql . " '0003',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '". $per ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '". $conforme ."',";
	$vsql = $vsql . " '". $tipito ."')";
	
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
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