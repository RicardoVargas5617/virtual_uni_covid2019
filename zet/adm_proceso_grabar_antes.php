<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$codigo = $_POST["codigo"];
	$tipo = $_POST['txtTipo'];

	$sede = $_POST["cboSede"];
	$semestre = $_POST['cboSemestre'];
	$tipoproceso = $_POST['cboTipoProceso'];
	$procesogeneral = $_POST['cboProcesoGeneral'];	
	
	$activo = $_POST['chkActivo'];	
	$descripcion = $_POST['txtDescripcion'];	
	$resolucion = $_POST['txtResolucion'];
	$fecharesolucion = $_POST['txtFechaResolucion'];
	$observacion = $_POST['txtObservacion'];
	$numeropreguntas = 100;
	$preguntabuena = 0;
	$preguntamala = 0;

	$presidente = $_POST['txtPresidente'];
	$secretario = $_POST['txtSecretario'];
	$vocal = $_POST['txtVocal'];
	
	$fecharesolucion = substr($fecharesolucion,6,4)."/".substr($fecharesolucion,3,2)."/".substr($fecharesolucion,0,2);

	$vsql = "call zyz_MantenedorProceso (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $sede ."',";
	$vsql = $vsql . " '". $tipoproceso ."',";
	$vsql = $vsql . " '". $semestre ."',";	
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " '". $observacion ."',";
	$vsql = $vsql . " '". $resolucion ."',";
	$vsql = $vsql . " '". $fecharesolucion ."',";
	$vsql = $vsql . " ". $numeropreguntas .",";
	$vsql = $vsql . " ". $preguntabuena .",";
	$vsql = $vsql . " ". $preguntamala .",";
	$vsql = $vsql . " ". $activo .",";
	$vsql = $vsql . " '". $procesogeneral ."',";
	$vsql = $vsql . " '". $presidente ."',";
	$vsql = $vsql . " '". $secretario ."',";
	$vsql = $vsql . " '". $vocal ."',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cnzet, $vsql);
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