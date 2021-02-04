<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}
	require ("sessiones.php");
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$proceso = $_POST["proceso"];	
	$tipo = 'Z';
	$vsql = "call zyz_CAProcesoAmbiente (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '1900-01-01',";
	$vsql = $vsql . " '". $persona ."',";
	$vsql = $vsql . " '". $usuario ."','','',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
			}
	else
			{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			}
?>