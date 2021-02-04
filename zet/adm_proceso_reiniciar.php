<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$tipo = 'R';	
	
	
	$vsql = "call zyz_MantenedorProceso (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '1',";
	$vsql = $vsql . " '2',";
	$vsql = $vsql . " '3',";
	$vsql = $vsql . " '4',";
	$vsql = $vsql . " '5',";
	$vsql = $vsql . " '6',";	
	$vsql = $vsql . " '1900-01-01',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";	
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";		
	$vsql = $vsql . " '1',";
	$vsql = $vsql . " '2',";
	$vsql = $vsql . " '3',";
	$vsql = $vsql . " '4',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cn, strtoupper($vsql));
	$nroerror=mysqli_errno($cn);
	$msg=messageError(mysqli_errno($cn));

	mysqli_close($cn);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se cambiaron las claves'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>