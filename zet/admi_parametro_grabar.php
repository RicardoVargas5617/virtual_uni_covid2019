<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$proceso = $_POST['cboProceso'];
	#$fechainicio = $_POST['txtFechaInicio'];
	#$horainicio = $_POST['txtHoraInicio'];
	#$fechafin = $_POST['txtFechaFin'];
	#$horafin = $_POST['txtHoraFin'];
	$activo = $_POST['chkActivo'];
	$modoexamen = $_POST['chkModoExamen'];
	#$fechainicio = substr($fechainicio,6,4).'/'.substr($fechainicio,3,2).'/'.substr($fechainicio,0,2);
	#$fechafin = substr($fechafin,6,4).'/'.substr($fechafin,3,2).'/'.substr($fechafin,0,2);
	#$fechainicio = $fechainicio . ' '. $horainicio;
	#$fechafin = $fechafin . ' '. $horafin;
	$fechainicio = '1900-01-01';
	$fechafin = '1900-01-01';
	#$activo = 1;

	$vsql = "call zyz_Admi_ParametrosGenerales (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $fechainicio ."',";
	$vsql = $vsql . " '". $fechafin ."',";
	$vsql = $vsql . " ". $activo .",";
	$vsql = $vsql . " ". $modoexamen .",";	
	$vsql = $vsql . " 'A')";
	#echo $vsql;
	#exit;

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