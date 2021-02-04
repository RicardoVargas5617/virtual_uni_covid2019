<?php
	session_start();
	include_once("sessiones.php");
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	$proceso = base64_decode(base64_decode($_POST["proceso"]));	
	$postulante = $_POST["cboPostulante"];
	$observacion = $_POST["txtObservacion"];
	$tipo = $_POST['txtTipo'];	
	
	$vsql = "call zoz_Admi_Sancionado (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $postulante ."',";
	$vsql = $vsql . " '". $observacion ."',";
	$vsql = $vsql . " '". $usuario ."',";
	$vsql = $vsql . " '". $persona ."',";
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