<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	include(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");	
	$codigo = $_POST["hidCodigo"];
	$tipo = $_POST['txtTipo'];
	$dni = $_POST['dni'];	
	$apellidopaterno = $_POST['txtApellidoPaterno'];
	$apellidomaterno = $_POST['txtApellidoMaterno'];
	$nombres = $_POST['txtNombres'];
	$email = $_POST['txtEmail'];
	$celular = $_POST['txtCelular'];
	$clavel = $_POST['txtClave'];
	$observacion = $_POST['txtObservacion'];
	#$validar = $_POST['chkActivo'];
	$activo = $_POST['chkActivo'];	
	#echo $_POST['chkActivo'];
	#if (isset($_POST['chkActivo']))
	#	{
	#		$activo = 1;
	#	}	
	#else
	#	{
	#		$activo = 0;
	#	}
		
	#echo $activo;
		
	#if ($validar == 1)
	#	{
	#		$activo = 1;
	#	}
	#else
	#	{
	#		$activo = 0;
	#	}


	
	$vsql = "call zyz_Admi_GrabarPre (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $dni ."',";
	$vsql = $vsql . " '". $apellidopaterno ."',";
	$vsql = $vsql . " '". $apellidomaterno ."',";
	$vsql = $vsql . " '". $nombres ."',";
	$vsql = $vsql . " '". $email ."',";
	$vsql = $vsql . " '". $celular ."',";
	$vsql = $vsql . " '". $clavel ."',";
	$vsql = $vsql . " '". $observacion ."',";
	$vsql = $vsql . " ". $activo .",0,";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	//echo $paginaactual;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	
	#if ($activo==1)
	#	{
	#		$z = enviar_email($codigo, $dni);
	#	}
	#else
	#	{
	#		$z = '0';	
	#	}
	$z=1;
		
	if($z==1)
		{
			$men = 'Se grabo la informacion ingresada y se envi&oacute; el email';
		}
	else
		{
			$men = 'Se grabo la informacion ingresada';	
		}
	
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	
	if($rs){
			echo json_encode(array('error'=>0,'mensaje'=>$men));
	}
	else{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
	}
?>