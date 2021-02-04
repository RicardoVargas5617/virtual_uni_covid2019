<?php
	session_start();
	if (!isset($_SESSION["usuario"]) or  $_SERVER['HTTP_REFERER'] == "")
	{
		header("location:noautorizado.php");
	}	
	include_once "sessiones.php";
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$tipo = $_POST['txtTipo'];
	if ($tipo=='A')
		{
			$codigo = $_POST['codigo'];
			$per = substr($codigo,0,8);
			$tra = substr($codigo,8,8);			
		}
	else
		{
			$codigo = "";
			$per = "";
			$tra = "";			
		}		

	$escuela = $_POST["cboEscuela"];
	$sede = $_POST["cboSede"];
	$activo = $_POST["chkActivo"];
	$varon = $_POST["chkVaron"];
	
	$tipodocumento = $_POST["cboTipoDocumento"];
	$numerodocumento = $_POST["txtNumeroDocumento"];
	$apellidopaterno = $_POST["txtApellidoPaterno"];
	$apellidomaterno = $_POST["txtApellidoMaterno"];
	$primernombre = $_POST["txtPrimerNombre"];
	$segundonombre = $_POST["txtSegundoNombre"];
	$nombrecompleto = $apellidopaterno.' '.$apellidomaterno;
	$fechanacimiento = $_POST["txtFechaNacimiento"];
	if (trim($fechanacimiento)=='')
		{
			$fechanacimiento='null';
		}
	else
		{
		$fechanacimiento = substr($_POST['txtFechaNacimiento'],6,4)."/".substr($_POST['txtFechaNacimiento'],3,2)."/".substr($_POST['txtFechaNacimiento'],0,2);
		}
		
	$email = $_POST["txtEmail"];
	$telefono = $_POST["txtTelefono"];
	$celular = $_POST["txtCelular"];
	$perfil = $_POST["cboPerfil"];
	$direccion = $_POST["txtDireccion"];

	
	$vsql = "call zyz_Man_Usuario (";
	$vsql = $vsql . " '". $per ."',";
	$vsql = $vsql . " '". $tra ."',";
	$vsql = $vsql . " '". $sede ."',";
	$vsql = $vsql . " '". $escuela ."',";
	$vsql = $vsql . " '". $perfil ."',";
	$vsql = $vsql . " ". $activo .",";
	$vsql = $vsql . " '". $apellidopaterno ."',";	
	$vsql = $vsql . " '". $apellidomaterno ."',";
	$vsql = $vsql . " '". $primernombre ."',";
	$vsql = $vsql . " '". $segundonombre ."',";
	$vsql = $vsql . " ". $varon .",";
	if (trim($fechanacimiento)=='null')
		{
			$vsql = $vsql . " null,";
		}
	else
		{
			$vsql = $vsql . " '". $fechanacimiento ."',";
		}
	$vsql = $vsql . " '". $email ."',";
	$vsql = $vsql . " '". $telefono ."',";
	$vsql = $vsql . " '". $celular ."',";
	$vsql = $vsql . " '". $tipodocumento ."',";
	$vsql = $vsql . " '". $numerodocumento ."',";
	$vsql = $vsql . " '". $direccion ."',";
	$vsql = $vsql . " '". $vperfil ."',";
	$vsql = $vsql . " '". $usuario ."',";
	$vsql = $vsql . " '". $persona ."',";
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;	
	$rs=mysqli_query($cnzet, $vsql);
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