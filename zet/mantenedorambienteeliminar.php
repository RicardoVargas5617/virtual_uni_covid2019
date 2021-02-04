<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_GET['clave'];
	$tipo = 'E';	
	$local = substr($codigo,0,3);
	$ambiente = substr($codigo,3,4);
	$vsql = "call zyz_CAMantenedorAmbiente ('". $codigo . "','','',0,'','',0,'E')";	
	//echo $vsql;
	//exit;
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