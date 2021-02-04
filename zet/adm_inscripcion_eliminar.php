<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);
	$tipo = 'E';	
	$vsql = "call zyz_CAMantenedorPostulante (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $postulante ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '1900-01-01',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";	
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
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " 0,'00','00','00','','',0,0,'','1','2','3','4','5','6','7',";
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