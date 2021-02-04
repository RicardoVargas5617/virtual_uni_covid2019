<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["hidCodigo"];
	$proceso = substr($codigo,0,4);
	$clave = substr($codigo,4,2);
	$sub = $_POST['cboPregunta'];
	$tipozet = substr($sub,0,2);
	$subtipo = substr($sub,2,2);
	$pregunta = $_POST['txtPregunta'];
	$orden = $_POST['txtOrden'];
	$tipo = $_POST['txtTipo'];

	$vsql = "call zyz_Admi_Estructura (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $clave ."',";
	$vsql = $vsql . " '". $subtipo ."',";
	$vsql = $vsql . " '". $tipozet ."',";		
	$vsql = $vsql . " ". $pregunta .",";
	$vsql = $vsql . " ". $orden .",";
	$vsql = $vsql . " '". $tipo ."')";

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
			}
?>