<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["codigo"];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);
	$conforme = $_POST['chkConforme'];	
	
	#echo $conforme;
	#if (isset($_POST['chkConforme'])) 
	#	{
	#		$vconforme = 1;
	#	}
	#else
	#	{
	#		$vconforme = 0;
	#	}
	#echo $vconforme;
	#if ($conforme == 1)
	#	{
	#		$vconforme = 1;
	#	}
	#else
	#	{
	#		$vconforme = 0;
	#	}
	
	$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "','". $postulante . "','1','2','3','4','5','1900-01-01','7','8','9','10','1',". $conforme . ",0,'1','2','3','4','5','6','7',0,0,0,0,0,'1','2','3','4','5',0,0,'','1','2','3','4','5','6','7','S')";
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
	else{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
	}
?>