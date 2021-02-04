<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');

	$cn = conectar();
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);
	$tipo = $_GET['tipo'];
	$valor = $_GET['val'];
	#echo $valor;
	if ($valor==0)
		{
			$valor=1;	
		}
	elseif ($valor==1)
		{
			$valor=0;
		}
	#echo '<br>';
	#echo $valor;
	$vsql = "call zoz_CAControl ('". $proceso . "', '', '". $postulante . "', ". $valor . ",'". $tipo . "')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cn, strtoupper($vsql));
	$nroerror=mysqli_errno($cn);
	$msg=messageError(mysqli_errno($cn));

	mysqli_close($cn);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se actualizo la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>