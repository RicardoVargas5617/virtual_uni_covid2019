<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["hidCodigo"];
	$clave = $_POST["hidClave"];
	$paginaactual = $_POST["hidPaginaActual"];
	$descripcion = $_POST['txtDescripcion'];
	$tipo = $_POST['txtTipo'];	
	$vactivo = $_POST['chkActivo'];	
	$tipo = $_POST['txtTipo'];
	$vsql = "call zyz_Man_Maestro (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $tipo ."',";
	$vsql = $vsql . " '". $clave ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " ". $vactivo .")";
	#echo $vsql;
	#exit;
	//echo $paginaactual;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se grabaron la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>