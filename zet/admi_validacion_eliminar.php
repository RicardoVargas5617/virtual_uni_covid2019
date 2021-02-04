<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$clave = base64_decode(base64_decode($_GET['clave']));
	$tipo = 'E';	
	
	$vsql = "call zyz_Admi_GrabarPre (";	
	$vsql = $vsql . " '". $clave ."',";
	$vsql = $vsql . " '','','','','','','','',";
	$vsql = $vsql . " 0,";	
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 'E')";
	//echo $vsql;
	$rs=mysqli_query($cn, strtoupper($vsql));
	$nroerror=mysqli_errno($cn);
	$msg=messageError(mysqli_errno($cn));
	mysqli_close($cn);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se elimino la informacion ingresada'));
	}
	else{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
	}
?>