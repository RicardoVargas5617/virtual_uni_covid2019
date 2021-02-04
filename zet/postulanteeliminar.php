<?php
session_start();
include_once "../config.php";
include_once(GL_DIR_FS_APP.'funciones/admi_con.php');
$cn = conectar();

foreach ($_REQUEST as $k=>$v)
{
    $k=base64_decode($k);
    $v=base64_decode($v);
    $$k=$v;
    // echo $k.'-->'.$v.'<br/>';
}
$vsql="call sp_admPostulanteEliminar(
    '$persona',
	'$postulante',
	'$sede',
	'$semestre',
	'$fase',
	'$estructura',
	'$modalidad',
	'$tipo')";
$rs=mysqli_query($cn, strtoupper($vsql));
$nroerror=mysqli_errno($cn);
$msg=messageError(mysqli_errno($cn));
//print_r($rs);
if($rs){
    echo json_encode(array('error'=>0,'mensaje'=>'Se eliminado la inscripción'));
}else{
    echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
}