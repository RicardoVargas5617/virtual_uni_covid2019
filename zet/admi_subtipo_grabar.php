<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	$tipoadmi = $_POST["hidTipo"];	
	$subtipo = $_POST["hidCodigo"];
	$descripcion = $_POST['txtDescripcion'];
	$vactivo = $_POST['chkActivo'];
	$tipo = $_POST['txtTipo'];	
	
	$vsql = "call zyz_Admi_SubTipo (";	
	$vsql = $vsql . " '". $tipoadmi ."',";
	$vsql = $vsql . " '". $subtipo ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " ". $vactivo .",";	
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cn_zet, $vsql);
	$nroerror=mysqli_errno($cn_zet);
	$msg=messageError(mysqli_errno($cn_zet));
	mysqli_close($cn_zet);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>