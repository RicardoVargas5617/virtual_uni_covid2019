<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$pos = $_POST["postulante"];	
	$validado = $_POST['chkValidado'];
	$doc = $_POST['chkDoc'];

	$vsql = "call zyz_CAConstancia (";	
	$vsql = $vsql . " '0003',";
	$vsql = $vsql . " '". $doc ."',";
	$vsql = $vsql . " '". $pos ."',";
	$vsql = $vsql . " '',";
	$vsql = $vsql . " '". $validado ."',";	
	$vsql = $vsql . " 'V')";
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