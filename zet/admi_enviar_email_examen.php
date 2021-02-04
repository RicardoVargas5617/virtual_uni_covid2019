<?php
	include('../config.php');
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	include(GL_DIR_FS_APP.'funciones/funciones_admision.php');
	#echo 'hola';
	$codigo = base64_decode(base64_decode($_GET['clave']));
	$tipo = substr($codigo,0,1);
	$proceso = substr($codigo,1,4);
	$postulante = substr($codigo,5,7);
	#echo '<br>';
	#echo $codigo;
	#exit;
	$z = enviar_email_examen($proceso, $postulante, $tipo);

	if ($z=='1')
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se envi&oacute; la informaci&oacute;n al email del postulante'));
		}
	else
		{
			echo json_encode(array('error'=>1,'mensaje'=>'Se produjo un error...'));
		}

?>