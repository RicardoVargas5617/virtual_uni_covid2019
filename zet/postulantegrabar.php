<?php
session_start();
include_once "../config.php";
include_once(GL_DIR_FS_APP.'funciones/admi_con.php');
$cn = conectar();
$persona='';
$postulante='';
$sede='';
$semestre='';
$fase='';
$estructura='';
$tipoingreso='';
$modalidad='';
$usuario='';
$promotor='';
$fechacaptacion='';
$convenio='';
$principal='1';
$resolucion='';
$fecharesolucion='';
$fechapago='';
$observacionpago='';
$mediocomunicacion='';
foreach($_POST as $k=>$v){
    $k=substr($k,3);
    $$k=$v;
}

$usuario=$_SESSION['usuario'];
if($fecharesolucion!='')
{
    $arrfecharesol=explode("/",$fecharesolucion);
    $fecharesolucion=$arrfecharesol[2].'/'.$arrfecharesol[1].'/'.$arrfecharesol[0];
}else{
	$fecharesolucion='0000/00/00';
}
if($fechapago!='')
{
    $arrfechapago=explode("/",$fechapago);
    $fechapago=$arrfechapago[2].'/'.$arrfechapago[1].'/'.$arrfechapago[0];
}
if($fechacaptacion!='')
{
    $fechacaptacion=explode("/",$fechacaptacion);
    $fechacaptacion=$fechacaptacion[2].'/'.$fechacaptacion[1].'/'.$fechacaptacion[0];
}else{
	$fechacaptacion='0000/00/00';
}
 $vsql="call sp_admPostulanteAdmisionGrabar(
'$persona','$postulante','$sede','$semestre','$faseadmision','$estructura','$tipoingreso','$modalidad','$usuario','$promotor',
'$fechacaptacion','$convenio','$principal','$resolucion','$fecharesolucion','$fechapago','$numerorecibo','$observacionpago','$mediocomunicacion')";

#echo $vsql;

$rs=mysqli_query($cn, strtoupper($vsql));
$nroerror=mysqli_errno($cn);
$msg=messageError(mysqli_errno($cn));
//print_r($cn);
if($rs){
    echo json_encode(array('error'=>0,'mensaje'=>'Se grabaron la informacion ingresada'));
}else{
    echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
}
?>