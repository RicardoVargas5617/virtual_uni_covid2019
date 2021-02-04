<?php
	session_start();
	if (!isset($_SESSION["usuario"]) or  $_SERVER['HTTP_REFERER'] == "")
	{
		header("location:noautorizado.php");
	}	
	include_once "sessiones.php";
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$tipo = $_POST['txtTipo'];
	$dni = $_POST["txtDni"];
	$nombrecompleto = $_POST["txtNombreCompleto"];
	$email = $_POST["txtEmail"];
	$celular = $_POST["txtCelular"];
	$activo = $_POST['chkActivo'];
	$clavel = $_POST['txtClavel'];

	
	$vsql = "call zyz_Man_Supervisor (";
	$vsql = $vsql . " '". $dni ."',";
	$vsql = $vsql . " '". $nombrecompleto ."',";
	$vsql = $vsql . " '". $email ."',";
	$vsql = $vsql . " '". $celular ."',";
	$vsql = $vsql . " ". $activo .",";
	$vsql = $vsql . " '". $clavel ."',";	
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;	
	$rs=mysqli_query($cnzet, $vsql);
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
			}
	else
			{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			};
?>