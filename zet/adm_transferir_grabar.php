<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$proceso = $_POST["proceso"];
	$procesonuevo = $_POST["cboProcesoNuevo"];
	$proceso = base64_decode(base64_decode($proceso));
	$tipo = 'H';
	
	$vsql = "call zyz_MantenedorProceso (";	
	$vsql = $vsql . " '". $proceso ."',";
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
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '". $procesonuevo ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	//echo $paginaactual;
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