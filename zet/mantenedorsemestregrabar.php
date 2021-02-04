<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["hidCodigo"];
	$paginaactual = $_POST["hidPaginaActual"];
	$descripcion = $_POST['txtDescripcion'];
	$fechainicio = $_POST["cboAnio"].'/'.$_POST["cboMes"].'/'.$_POST["cboDia"];
	$fechafin = $_POST["cboAnioFin"].'/'.$_POST["cboMesFin"].'/'.$_POST["cboDiaFin"];
	$vactivo = $_POST['chkActivo'];	
	$vvigente = $_POST['chkVigente'];	
	$tipo = $_POST['txtTipo'];
	$vsql = "call zyz_CAMantenedorSemestre (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " '". $fechainicio ."',";
	$vsql = $vsql . " '". $fechafin ."',";
	$vsql = $vsql . " ". $vactivo .",";
	$vsql = $vsql . " ". $vvigente .",";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	//echo $paginaactual;
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