<?php
	include_once "../config.php";
	include('../funciones/admi_con.php');
	$cnzet = conectar();
	$proceso = $_POST["proceso"];
	$postulante = $_POST["postulante"];
	$tipo = $_POST["txtTipo"];
	$escuelamodalidad = $_POST["cboEscuelaModalidad"];
	$escuela=substr($escuelamodalidad,0,2);
	$modalidadadmision=substr($escuelamodalidad,2,2);
	$apellidopaterno = $_POST['txtApellidoPaterno'];
	$apellidomaterno = $_POST['txtApellidoMaterno'];
	$nombre = $_POST['txtNombre'];	
	$fechanacimiento = $_POST['txtFechaNacimiento'];
	$fechanacimiento = substr($fechanacimiento,6,4)."/".substr($fechanacimiento,3,2)."/".substr($fechanacimiento,0,2);
	$numerodocumento = $_POST['txtNumeroDocumento'];
	$sexo = $_POST['cboSexo'];
	$recibopago = $_POST['txtReciboPago'];
	$email = $_POST['txtEmail'];
	$telefono = $_POST['txtTelefono'];
	$colegio = $_POST['txtColegio'];
	
	$vsql = "call zyz_CAMantenedorPre (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $postulante ."',";
	$vsql = $vsql . " '". $modalidadadmision ."',";
	$vsql = $vsql . " '". $escuela ."',";
	$vsql = $vsql . " '". $apellidopaterno ."',";
	$vsql = $vsql . " '". $apellidomaterno ."',";
	$vsql = $vsql . " '". $nombre ."',";
	$vsql = $vsql . " '". $fechanacimiento ."',";
	$vsql = $vsql . " '01',";
	$vsql = $vsql . " '". $numerodocumento ."',";
	$vsql = $vsql . " '". $sexo ."',";
	$vsql = $vsql . " '". $recibopago ."',";
	$vsql = $vsql . " '". $email ."',";
	$vsql = $vsql . " '". $telefono ."',";
	$vsql = $vsql . " '". $colegio ."',";	
	$vsql = $vsql . " '". $tipo ."')";
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	#echo '';
	if($rs)
		{
			#echo json_encode(array('error'=>0,'mensaje'=>'Se grab&oacute; la informaci&oacute;n correctamente, ac&eacute;rquese a la Oficina de Admisi&oacute;n para formalizar la inscripci&oacute;n.'));
			echo 'Se grab&oacute; la informaci&oacute;n correctamente, ac&eacute;rquese a la Oficina de Admisi&oacute;n para formalizar la inscripci&oacute;n.';
		}
	else
		{
			echo 'Se produjo un error, intente nuevamente.';
			#echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>