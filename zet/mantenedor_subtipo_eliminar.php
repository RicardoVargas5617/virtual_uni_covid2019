<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$clave = $_GET['clave'];
	$tipo = 'E';
	$dominio = substr($clave,0,2);
	$modulo = substr($clave,2,3);
	$menu = substr($clave,5,3);
	$vsql = "call zyz_CAMantenedorMenu ('". $dominio . "','". $modulo . "','". $menu . "','',0,0,'E')";	
	//echo $vsql;
	//echo $vsql;
	$rs=mysqli_query($cn, strtoupper($vsql));
	$nroerror=mysqli_errno($cn);
	$msg=messageError(mysqli_errno($cn));
	mysqli_close($cn);
	if($rs)
	{
		echo json_encode(array('error'=>0,'mensaje'=>'Se elimino la informacion ingresada'));
	}
	else
	{
		echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
	}
?>