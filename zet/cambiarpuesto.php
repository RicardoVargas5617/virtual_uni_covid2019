<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	require_once('sessiones.php');
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cn_zun = conectar();
	$key=$_POST['ID'];
	
	$proceso = substr($key,0,4);
	$canal = substr($key,4,2);
	$subtipo = substr($key,6,2);
	$tipozet = substr($key,8,2);
	
	$ordenantes=$_POST['ordenantes'];
	$ordennuevo=$_POST['ordernuevo'];
	$ordennuevo=$ordennuevo+1;
	$vsql_pregunta = "call zyz_Admi_EstructuraPostulante ('". $persona . "','". $proceso . "','". $canal . "','". $subtipo . "','". 	$tipozet . "',". 	$ordennuevo . ",'". $vescuela . "','U')";
	
	#echo $vsql_pregunta;
	#exit;
	$rs=mysqli_query($cn_zun, $vsql_pregunta);
	#$nroerror=mysqli_errno($cnzet);
	
	#$msg=messageError(mysqli_errno($cnzet));
	#mysqli_close($cn_zun);
	#if($rs){
	#	echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
	#		}
	#else
	#		{
	#	echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
	#		}
?>