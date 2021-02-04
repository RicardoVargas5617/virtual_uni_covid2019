<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$codigo = $_GET['codigo'];
	$tipo = 'X';	
	$vsql = "call zyz_MantenedorProceso (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";	
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '1900-01-01',";
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " 1,'','','','',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	//echo $paginaactual;
	$rs=mysqli_query($cn, strtoupper($vsql));
	$nroerror=mysqli_errno($cn);
	$msg=messageError(mysqli_errno($cn));

	mysqli_close($cn);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se elimino la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>