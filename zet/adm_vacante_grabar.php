<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$proceso = $_POST["proceso"];
	$escuela = $_POST["cboEscuela"];
	$modalidadadmision = $_POST['cboModalidadadmision'];	
	#$puntaje = $_POST['txtPuntaje'];
	$puntaje = 0;	
	$vacante = $_POST['txtVacante'];
	$tipo = $_POST["txtTipo"];
	
	$vsql = "call zyz_CAMantenedorVacante (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $modalidadadmision ."',";
	$vsql = $vsql . " '". $escuela ."',";
	$vsql = $vsql . " ". $vacante .",";	
	$vsql = $vsql . " ". $puntaje .",";
	$vsql = $vsql . " '". $tipo ."')";
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