<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$sede = $_POST['cboSede'];
	$semestre = $_POST['cboSemestre'];
	$ciclo = $_POST['txtCiclo'];
	$certificado = $_POST['txtCertificado'];
	$colacion = $_POST['txtColacion'];
	$saltoboleta = $_POST['txtBoleta'];
	$saltomatricula = $_POST['txtMatricula'];
	$moodle = $_POST['chkMoodle'];
	$vsql = "call zyz_CAParametrosGenerales (";	
	$vsql = $vsql . " '". $sede ."',";
	$vsql = $vsql . " '". $semestre ."',";
	$vsql = $vsql . " ". $ciclo .",";
	$vsql = $vsql . " ". $certificado .",";
	$vsql = $vsql . " '". $colacion ."',";
	$vsql = $vsql . " ". $saltoboleta .",";
	$vsql = $vsql . " ". $saltomatricula .",";
	$vsql = $vsql . " ". $moodle .",";
	$vsql = $vsql . " 'A')";
	//echo $vsql;
	//echo $paginaactual;
	$_SESSION["vsede"] = $sede;
	$_SESSION["vsemestre"] = $semestre;
	$_SESSION["moodle"] = $moodle;
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