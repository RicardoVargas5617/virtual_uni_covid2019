<?php
session_start();
include_once "../config.php";
include_once(GL_DIR_FS_APP.'funciones/admi_con.php');
$cn = conectar();
foreach($_POST as $key=>$valor){
    $key=substr($key,3);
    $$key=$valor;
   //echo '**';
}

//echo $departamentonacimiento.'--->'.$provincianacimiento.'----->'. $distritonacimiento.'########';
$departamentonacimiento=substr($distritonacimiento,0,2);
$provincianacimiento=substr($distritonacimiento,2,2);
$distritonacimiento=substr($distritonacimiento,4,2);
$telefonofijo=str_replace('(','',$telefonofijo);
$telefonofijo=str_replace(')','',$telefonofijo);
$telefonofijo=str_replace('_','',$telefonofijo);
$telefonofijo=str_replace(' ','',$telefonofijo);
$celular=str_replace(' ','',$celular);
$celular=str_replace('_','',$celular);
if($fechanacimiento!='') {
    $fechanacimiento = explode('/', $fechanacimiento);
    $fechanacimiento = $fechanacimiento[2] . '/' . $fechanacimiento[1] . '/' . $fechanacimiento[0];
}
$vsql="call sp_admPersonaPostulanteGrabar('$persona','$apellidopaterno','$apellidomaterno','$primernombre','$segundonombre'
,'$varon','$fechanacimiento','$tipodocumento','$numerodocumento','$niveleducativo','$tipovia','$celular','$telefonofijo','$paisnacimiento'
,'$departamentonacimiento','$provincianacimiento','$distritonacimiento'
,'$estadocivil','$tipozona','$direccion','$email')";
//echo $vsql;
$rspersona=mysqli_query($cn,$vsql);
$row=mysqli_fetch_array($rspersona,MYSQLI_ASSOC);
$nroerror=mysqli_errno($cn);
$msg=messageError(mysqli_errno($cn));
if($rspersona) {
    echo json_encode(array('error' => 0, 'mensaje' => 'Se grabaron la informacion ingresada', 'post' => $row));
}else{
    echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
}