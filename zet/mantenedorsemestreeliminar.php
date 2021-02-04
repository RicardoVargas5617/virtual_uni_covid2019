<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	
	$codigo = $_GET['clave'];
	$paginaactual = $_GET["paginaactual"];
	$tipo = 'E';	
	$vsql = "call zyz_CAMantenedorSemestre (";	
	$vsql = $vsql . " '". $codigo ."','','1900/01/01','1900/01/01',0,0,'". $tipo ."')";
	//echo $vsql;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));

	mysqli_close($cnzet);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se elimino la informacion ingresada'));
			}
	else{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			}
?>