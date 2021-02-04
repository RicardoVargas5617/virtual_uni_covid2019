<?php
	include_once('../funciones/admi_con.php');
	include_once('../funciones/admi_fun.php');

	$zet = '../';
	
	if (!isset($_POST["txtDni"]))
		{
			header ("location: admi_pre.php");
		}
		
	#$define('GL_DIR_FS_APPS', 'd:/xampp/htdocs');
	#echo 'hola';
	$dni = $_POST["txtDni"];
	$apellidopaterno = $_POST["txtApellidoPaterno"];
	$apellidomaterno = $_POST["txtApellidoMaterno"];
	$nombres = $_POST["txtNombres"];

	$estructura = $_POST["cboEstructura"];
	$modalidad = $_POST["cboModalidad"];
	$sexo = $_POST["cboSexo"];
	$email = $_POST["txtEmail"];
	$celular = $_POST["txtCelular"];
	$fechanacimiento = $_POST["txtFechaNacimiento"]; 
	$colegio = $_POST["txtColegio"];
	$anioegreso = $_POST["txtAnioEgreso"];

	$tipopago = $_POST["cboTipoPago"];
	$recibopago = $_POST["txtReciboPago"];
	$importepago = $_POST["txtImportePago"];
	$fechapago = $_POST["txtFechaPago"];
	
	$vsql = "call zyz_Admi_GrabarPre (";
	$vsql = $vsql . " '',";	
	$vsql = $vsql . " '". $dni ."',";
	$vsql = $vsql . " '". strtoupper(trim($apellidopaterno)) ."',";
	$vsql = $vsql . " '". strtoupper(trim($apellidomaterno)) ."',";
	$vsql = $vsql . " '". strtoupper(trim($nombres)) ."',";
	$vsql = $vsql . " '". $estructura ."',";
	$vsql = $vsql . " '". $modalidad ."',";
	$vsql = $vsql . " '". $sexo ."',";
	$vsql = $vsql . " '". $email ."',";
	$vsql = $vsql . " '". $celular ."',";
	$vsql = $vsql . " '". $fechanacimiento ."',";
	$vsql = $vsql . " '". $colegio ."',";
	$vsql = $vsql . " '". $anioegreso ."',";
	$vsql = $vsql . " '". $tipopago ."',";
	$vsql = $vsql . " '". $recibopago ."',";
	$vsql = $vsql . " '". $importepago ."',";
	$vsql = $vsql . " '". $fechapago ."',";
	$vsql = $vsql . " 'N')";
					
	echo $vsql;
	exit;

	$cn_foto = conectar();
	mysqli_query($cn_foto,"SET CHARACTER SET utf8");
	mysqli_query($cn_foto,"SET NAMES utf8");
	
	$max_size = 12000000;
	#################################################
	#################################################
	#define('GL_DIR_FS_APPS', 'd:/xampp/htdocs');
	$status_voucher = "";
	$destino_voucher = '../foto_voucher/'.$dni.'.jpg';
	$archivo_voucher = $_FILES['imgVoucher'];
	#################################################
	#################################################
	
	#################################################
	#################################################
	$status_postulante = "";
	$destino_postulante = '../foto_postulante/'.$dni.'.jpg';
	$archivo_postulante = $_FILES['imgEst'];
	#define('GL_DIR_FS_APPS', 'd:/xampp/htdocs');
	#################################################
	#################################################

	#################################################
	#################################################
	$status_dni = "";
	$destino_dni = '../foto_dni/'.$dni.'.jpg';
	$archivo_dni = $_FILES['imgDni'];
	#define('GL_DIR_FS_APPS', 'd:/xampp/htdocs');
	#################################################
	#################################################	
	
	#################################################
	#################################################
	$status_certificado = "";
	$destino_certificado = '../foto_certificado/'.$dni.'.jpg';
	$archivo_certificado = $_FILES['imgCertificadoEstudios'];
	#define('GL_DIR_FS_APPS', 'd:/xampp/htdocs');
	#################################################
	#################################################	
	

	#echo 'oiga';
	if ($archivo_postulante['size'] <= $max_size && $archivo_postulante['size'] > 0){
		include_once('pre_fotovoucher.php');
		include_once('pre_fotopostulante.php');
		include_once('pre_fotodni.php');
		#echo 'hola 1';
		if ($copied) {
			####
				#echo 'hola 2';
					

				#echo 'hola 3';
				#echo $vsql;
				#echo $vsql;
				
				#exit;
				mysqli_query($cn_foto, $vsql) or die (mysql_error());
			#########
			$msg = 'Se subio el archivo correctamente.';
			json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
			#echo 
		} else {
			$msg = 'Error!';
			json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #','mensaje'=>$msg));
			#echo 'holaz'; 
		}
	}else {
		$msg = 'Error!';
		json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #','mensaje'=>$msg));
		#echo 'hola error';
	}	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>UNIVERSIDAD NACIONAL DE JAEN</title>
    <link rel="icon" href="logo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous">
    </script>
</head>
<body background="../images/fondo.jpg">

                    <table width="100%">
                    <tr>
                    <td align="center">
                    <img src="../images/logo.png" alt="Logo" width="100"/>
                    <strong>UNIVERSIDAD NACIONAL DE JAEN</strong>
                    </td>
                    </tr>
                    <tr>
                    	<td align="center">
                        	<strong>REGISTRO CORRECTO</strong>
                        </td>
                    </tr>
                    </table>
</div>
<br>
<br>
<table width="100%" border="0">
	<tr>
    	<td width="30%">&nbsp;       	        
        </td>
        <td align="center">
        	<span style="font-size:22px;">
     		Estimado postulante, en el transcurso de 24 horas le llegar&aacute;n las instrucciones para completar su inscripci&oacute;n al correo electr&oacute;nico: 
            </span>
			<strong><h2><?php echo $email; ?></h2></strong> 
            <br> 
            <br>
            <span style="font-size:22px;">
            En caso de no recibir las instrucciones, <br>
            comuníquese con los siguientes números: 
            <br>
            <strong></strong>
            <p></br>
            <p><a href="https://google.com">Salir ahora <i class="fa fa-forward"></i></a> </p>
            </span>
        </td>        
        <td width="30%">&nbsp;        	
        </td>
    </tr>
</table>
</body>
</html>