<?php  
	exit;
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	include_once('../funciones/admi_con.php');
	include_once('../funciones/admi_fun.php');
	$cn_email = conectar();

	$asunto = "Usuario y password para el EXAMEN VIRTUAL PREFERENTE 20201-1";	
	$vsql = "call zyz_MantenedorProceso ('0012', '','','','','','','1900-01-01',0,0,0,1,'','','','','J')";
	$rs = mysqli_query($cn_email,	$vsql);

	while ($rsjk=mysqli_fetch_row($rs))
        {
			$nombre = $rsjk[1];
			$escuela = $rsjk[2];
			$numerodocumento = $rsjk[3];
			$clave = $rsjk[4];
			$email = $rsjk[5];
			$celular = $rsjk[6]; 
			
			$cuerpo = '
			<html>
			<head>
			  <title>...</title>
			</head>
			<body>
			  <p>Estimado <strong>'. $nombre .'</strong>, para rendir su examen virtual ingrese a:</p>
			  <table>
				<tr>
				  <td>
				  		<strong>
							<a href="https://unatadmision.org/admision/zet">https://unatadmision.org/admision/zet</a>
						</strong>
				  </td>
				</tr>
				<tr>
				  <td>
				  		<strong>Usuario: </strong>'.
						$numerodocumento.
				  '</td>
				</tr>
				<tr>
				  <td>
				  		<strong>Password: </strong>'.
						$clave.
				  '</td>
				</tr>
				<tr>
				  <td>
				  		<br>
				  		Cualquier consulta, comunicarse con nosotros al n&uacute;mero: <strong>979332963</strong>						
				  </td>
				</tr>
				<tr>
				  <td>
				  		<br>
						Atentamente					
				  </td>
				</tr>
				<tr>
				  <td>
				  		<br>
				  		<strong>Oficina de Admisi&oacute;n</strong>
				  </td>
				</tr>
			  </table>
			</body>
			</html>
			';

			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			#echo $cuerpo;
			#echo '<br>';
			mail($email, $asunto, $cuerpo, $cabeceras);
        }
?>

