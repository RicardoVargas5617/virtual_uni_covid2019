<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$modalidadadmision = substr($codigo,4,2);
	$escuela = substr($codigo,6,2);
	$tipo = 'E';	
	$vsql = "call zyz_CAMantenedorVacante (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $modalidadadmision ."',";
	$vsql = $vsql . " '". $escuela ."',";
	$vsql = $vsql . " 0,";	
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
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