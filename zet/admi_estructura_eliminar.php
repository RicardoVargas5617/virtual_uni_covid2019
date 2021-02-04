<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$proceso = substr($codigo,0,4);
	$canal = substr($codigo,4,2);
	$subtipo = substr($codigo,6,2);
	$tipo = substr($codigo,8,2);
	$vsql = "call zyz_Admi_Estructura (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $canal ."',";
	$vsql = $vsql . " '". $subtipo ."',";
	$vsql = $vsql . " '". $tipo ."',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";	
	$vsql = $vsql . " 'E')";
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
			}
?>