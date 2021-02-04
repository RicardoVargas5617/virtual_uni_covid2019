<?php
session_start();
include_once "../config.php";
include_once(GL_DIR_FS_APP.'funciones/admi_con.php');
$cn = conectar();
	$trabaja=0;
	$vivecon='';
	$costea='';
	$universidad='';
	$periodoegreso='';
	$profesion='';
	$grado='';
	$centrotrabajo='';
	$direcciontrabajo='';
	$telefonotrabajo='';
	$cargo='';
	$condicion='';
	$tipocolegio='';
	$colegio='';
	$anioegreso='';
	$vezpostula=0;
foreach($_POST as $key=>$valor){
    $key=substr($key,3);
    $$key=$valor;
    // echo '<br>';
}
$vsql="call sp_admPostulanteColegio('$persona','$trabaja','$vivecon','$costea','$institucionsuperior','$egresosuperior',
	'$profesion','$grado','$centrotrabajo','$direcciontrabajo','$telefonotrabajo','$cargotrabajo','$condicion',
	'$tipocolegio','$institucion','$egreso',$vezpostula)";
//echo $vsql;
$rscolegio=mysqli_query($cn,$vsql);
//print_r($cn);
$row=mysqli_fetch_array($rscolegio,MYSQLI_ASSOC);
$nroerror=mysqli_errno($cn);
$msg=messageError(mysqli_errno($cn));
if($rscolegio) {
    echo json_encode(array('error' => 0, 'mensaje' => 'Se grabaron la informacion ingresada', 'post' => $row));
}else{
    echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
}