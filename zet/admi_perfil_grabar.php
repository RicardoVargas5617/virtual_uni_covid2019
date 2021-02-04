<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	$codigo = $_POST["hidCodigo"];
	$descripcion = $_POST['txtDescripcion'];
	$activo = $_POST['chkActivo'];	
	if ($activo == 1)
		{
			$vactivo = 1;
		}
	else
		{
			$vactivo = 0;
		}
	$tipo = $_POST['txtTipo'];
	$vsql = "call zyz_Man_Perfil (";	
	$vsql = $vsql . " '". $codigo ."',";
	$vsql = $vsql . " '". $descripcion ."',";
	$vsql = $vsql . " ". $vactivo .",";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
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