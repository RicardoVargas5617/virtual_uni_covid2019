<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");

	$descripcion = $_POST["content"];
	$claveA = $_POST["txtClaveA"];
	$claveB = $_POST["txtClaveB"];
	$claveC = $_POST["txtClaveC"];
	$claveD = $_POST["txtClaveD"];
	$claveE = $_POST["txtClaveE"];
	$respuesta = $_POST["cboRespuesta"];
	$canal = $_POST["cboCanal"];
	$observacion = $_POST["txtObservacion"];
	$vimagen = 1;
	$vactivo = $_POST["chkActivo"];
	#if (isset($_POST["chkActivo"]))
	#	{
	#		$vactivo = 1;
	#	}		
	#else
	#	{
	#		$vactivo = 0;
	#	}

	$tipoadmision = $_POST["hidTipo"];
	$tipo = $_POST["txtTipo"];
	$banco = $_POST["banco"];
		
	$a = substr($tipoadmision,0,2);
	$b = substr($tipoadmision,2,2);
	

	#echo $descripcion;	
	
	$vsql = "call zyz_Admi_Pregunta (";	
	$vsql = $vsql . " '". $banco ."',";
	$vsql = $vsql . " '". $a ."',";
	$vsql = $vsql . " '". $b ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " '". $observacion ."',";
	$vsql = $vsql . " '". $claveA ."',";
	$vsql = $vsql . " '". $claveB ."',";
	$vsql = $vsql . " '". $claveC ."',";
	$vsql = $vsql . " '". $claveD ."',";
	$vsql = $vsql . " '". $claveE ."',";
	$vsql = $vsql . " '". $respuesta ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " ". $vimagen .",";	
	$vsql = $vsql . " ". $vactivo .",";	
	$vsql = $vsql . " '". $canal ."',";
	$vsql = $vsql . " '". $tipo ."')";
	
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cn_zet, $vsql);
	
	#if ($tipo=='N')
	#	{
	#		$rsjk = mysqli_fetch_row($rs);		
	#		$id = $rsjk[0];
	#		$foto = $rsjk[1];
	#		echo $foto;
	#		require_once ('adm_banco_grabarfoto.php');
	#		echo 'A';
	#	}
	
	$nroerror=mysqli_errno($cn_zet);
	$msg=messageError(mysqli_errno($cn_zet));
	mysqli_close($cn_zet);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
	//	print_r($_POST);exit;
?>