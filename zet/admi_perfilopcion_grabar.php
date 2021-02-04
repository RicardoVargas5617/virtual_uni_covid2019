<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["hidCodigo"];
	$perfil = substr($codigo,0,3);
	$dominio = substr($codigo,3,2);
	$opcion = $_POST['cboOpcion'];
	$tipo = $_POST['txtTipo'];
	$vsql = "call zyz_Man_PerfilOpcion (";	
	$vsql = $vsql . " '". $perfil ."',";
	$vsql = $vsql . " '". $dominio ."',";
	$vsql = $vsql . " '". $opcion ."',";
	$vsql = $vsql . " '". $tipo ."')";
	
	if ($opcion=='')
	{
		echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
		exit;	
	}
	#echo $vsql;
	//exit;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
			}
	else
			{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			}
?>