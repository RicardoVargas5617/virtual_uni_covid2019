<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cn_zet = conectar();
	$codigo = $_POST["hidCodigo"];
	$descripcion = $_POST['txtDescripcion'];
	$semestre = $_POST["cboSemestre"];
	$activo = $_POST['chkActivo'];	
	$tipo = $_POST['txtTipo'];
	$vsql = "call zyz_MantenedorProcesoGeneral (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " '". $semestre ."',";
	$vsql = $vsql . " ". $activo .",'1900-01-01','',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;

	$rs=mysqli_query($cn_zet, strtoupper($vsql));
	$nroerror=mysqli_errno($cn_zet);
	$msg=messageError(mysqli_errno($cn_zet));
	mysqli_close($cn_zet);
	
	if($rs){
		echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
			}
	else
			{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			}
?>