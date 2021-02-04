<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["hidCodigo"];	
	$sede = $_POST["hidSede"];	
	$descripcion = $_POST['txtDescripcion'];
	$tipo = $_POST['txtTipo'];
	$vactivo = $_POST['chkActivo'];

	$vsql = "call zyz_CAMantenedorLocal (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " '". $sede ."',";
	$vsql = $vsql . " ". $vactivo .",";	
	$vsql = $vsql . " '". $tipo ."')";
	//echo $vsql;
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
			};
?>