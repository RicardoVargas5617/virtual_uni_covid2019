<?php
	session_start();
	include_once("sessiones.php");
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = base64_decode(base64_decode($_GET['clave']));
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);
	$tipo = 'E';	
	$vsql = "call zoz_Admi_Sancionado ('". $proceso . "','". $postulante . "','','". $usuario . "','". $persona . "','E')";	
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se elimino la informacion ingresada'));
	}
	else{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
	};
?>