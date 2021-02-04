<?php
	session_start();
	include_once('../funciones/admi_con.php');
	include_once "../zet/sessiones.php";
	$cn = conectar();
	$claveactual=$_POST['txtclaveactual'];
	$clavenueva=$_POST['txtclavenueva'];
	$vsql="call zoz_CambiarClave('$persona','$claveactual','$clavenueva')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cn, $vsql);
	$row=mysqli_fetch_array($rs,MYSQLI_ASSOC);
	$nroerror=mysqli_errno($cn);
	$msg=messageError(mysqli_errno($cn));
	mysqli_close($cn);
	if($rs)
			{
				echo json_encode(array('error'=>$row['error'],'mensaje'=>$row['mensaje']));
			}
	else
			{
				echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
			}
?>