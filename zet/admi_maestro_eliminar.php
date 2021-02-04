<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$codigo = $_GET['codigo'];
	$clave = $_GET['clave'];
	$paginaactual = $_GET["paginaactual"];
	$tipo = 'E';	
	$vsql = "call zyz_Man_Maestro (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $tipo ."',";
	$vsql = $vsql . " '". $clave ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 0)";
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