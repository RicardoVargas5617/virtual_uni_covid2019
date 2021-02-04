<?php
	include_once "../config.php";
	include(GL_DIR_FS_APP.'funciones/admi_con.php');
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$proceso = $_POST["proceso"];
	$postulante = $_POST["postulante"];
	$pre = $_POST["pre"];
	$tipo = $_POST["txtTipo"];
	$escuelamodalidad = $_POST["cboEscuelaModalidad"];
	$escuela=substr($escuelamodalidad,0,2);
	$modalidadadmision=substr($escuelamodalidad,2,2);
	$apellidopaterno = $_POST['txtApellidoPaterno'];
	$apellidomaterno = $_POST['txtApellidoMaterno'];
	$nombre = $_POST['txtNombre'];	
	$fechanacimiento = $_POST['txtFechaNacimiento'];
	$fechanacimiento = substr($fechanacimiento,6,4)."/".substr($fechanacimiento,3,2)."/".substr($fechanacimiento,0,2);
	$anioegreso = $_POST['txtAnioEgreso'];
	$tipocolegio = $_POST['cboTipoColegio'];
	$moda = '01';
	$tipodocumento = '01';
	$numerodocumento = $_POST['dni'];
	$sexo = $_POST['cboSexo'];
	$vecesunj = $_POST['txtVecesUnj'];
	$vecesotra = $_POST['txtVecesOtra'];
	$tipopago = '';
	$recibopago = $_POST['txtReciboPago'];
	$tipoprocedencia = $_POST['cboTipoProcedencia'];
	$direccion = $_POST['txtDireccion'];
	$certificado = 0;
	$email = $_POST['txtEmail'];
	$telefono = $_POST['txtTelefono'];
	#$departamento = $_POST['cboDepartamento'];
	#$provincia = $_POST['cboProvincia'];
	#$distrito = $_POST['cboDistrito'];
	$departamento = '03';
	$provincia = '02';
	$distrito = '01';
	$colegio = $_POST['txtColegio'];
	$pago1 = 0;
	$pago2 = 0;
	$turno = 'M';
	$celular = "";
	#$_POST['txtCelular']
	
	$vsql = "call zyz_CAMantenedorPostulante (";	
	$vsql = $vsql . " '". $proceso ."',";
	$vsql = $vsql . " '". $pre ."',";
	$vsql = $vsql . " '". $modalidadadmision ."',";
	$vsql = $vsql . " '". $escuela ."',";
	$vsql = $vsql . " '". $apellidopaterno ."',";
	$vsql = $vsql . " '". $apellidomaterno ."',";
	$vsql = $vsql . " '". $nombre ."',";
	$vsql = $vsql . " '". $fechanacimiento ."',";
	$vsql = $vsql . " '". $anioegreso ."',";
	$vsql = $vsql . " '". $tipocolegio ."',";
	$vsql = $vsql . " '". $tipodocumento ."',";
	$vsql = $vsql . " '". $numerodocumento ."',";
	$vsql = $vsql . " '". $sexo ."',";
	$vsql = $vsql . " ". $vecesunj .",";
	$vsql = $vsql . " ". $vecesotra .",";	
	$vsql = $vsql . " '". $tipopago ."',";
	$vsql = $vsql . " '". $recibopago ."',";
	$vsql = $vsql . " '". $tipoprocedencia ."',";
	$vsql = $vsql . " '". $direccion ."',";
	$vsql = $vsql . " '". $email ."',";
	$vsql = $vsql . " '". $telefono ."',";
	$vsql = $vsql . " '". $celular ."',";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 0,";
	$vsql = $vsql . " 1,";
	$vsql = $vsql . " ". $certificado .",";
	$vsql = $vsql . " '". $departamento ."',";
	$vsql = $vsql . " '". $provincia ."',";
	$vsql = $vsql . " '". $distrito ."',";
	$vsql = $vsql . " '". $colegio ."',";
	$vsql = $vsql . " '". $moda ."',";
	$vsql = $vsql . " ". $pago1 .",";
	$vsql = $vsql . " ". $pago2 .",";
	$vsql = $vsql . " '". $turno ."','1','2','3','4','5','6','7',";	
	$vsql = $vsql . " '". $tipo ."')";
	
	#echo $vsql;
	#exit;
	$rs=mysqli_query($cnzet, strtoupper($vsql));
	$nroerror=mysqli_errno($cnzet);
	$msg=messageError(mysqli_errno($cnzet));
	mysqli_close($cnzet);
	if($rs)
		{
			echo json_encode(array('error'=>0,'mensaje'=>'Se grabaron la informacion ingresada'));
		}
	else
		{
			echo json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #'.$nroerror,'mensaje'=>$msg));
		}
?>