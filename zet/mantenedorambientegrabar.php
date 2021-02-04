<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$ambiente = $_POST["hidCodigo"];
	#$local = substr($codigo,0,3);
	#$ambiente = substr($codigo,3,4);
	$local = $_POST["hidLocal"];	
	$descripcion = $_POST['txtDescripcion'];
	$observacion = $_POST['txtObservacion'];	
	$capacidad = $_POST['txtCapacidad'];
	$tipoambiente = $_POST['cboTipoAmbiente'];
	$vactivo = $_POST['chkActivo'];
	$tipo = $_POST['txtTipo'];	
	
	$vsql = "call zyz_CAMantenedorAmbiente (";	
	$vsql = $vsql . " '". $ambiente ."',";
	$vsql = $vsql . " '". $local ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " ". $capacidad .",";
	$vsql = $vsql . " '". $tipoambiente ."',";
	$vsql = $vsql . " '". $observacion ."',";
	$vsql = $vsql . " ". $vactivo .",";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
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