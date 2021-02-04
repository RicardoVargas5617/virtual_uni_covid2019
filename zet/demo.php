<?php
	#session_start();
	#if (!isset($_SESSION["usuario"]))
	#{
	#	header("location:noautorizado.php");
	#}			
	include_once "../config.php";
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	include('../funciones/admi_fun_admision.php');
	require_once GL_DIR_FS_APP.'vendor/autoload.php';
	ini_set('display_errors', '1');
	$cnzet = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);		
	$nombreproceso = nombreproceso($proceso);
	$macro = nombremacro($proceso);
	$mpdf = new \Mpdf\Mpdf();
	
	########################
	#######################
	$titulo = 'FICHA DE INSCRIPCION DEL POSTULANTE';
$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','',0,0,'','','','','','','',0,0,0,0,0,'00','00','00','','',0,0,'','G''1','2','3','4','5','6','7',)";	
	#echo $vsql;
	$rs = mysqli_query($cnzet,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			$nombremodalidad = $row["nombremodalidadadmision"];
			$nombreescuela = $row["nombreescuela"];
			$apellidopaterno = $row["apellidopaterno"];
			$apellidomaterno = $row["apellidomaterno"];
			$nombre = $row["nombre"];
			$fechanacimiento = $row["fechanacimiento"];
			$nombreadmision = $row["nombreadmision"];
			$numerodocumento = $row["numerodocumento"];
			$dni = $row["numerodocumento"];
			$sexo = $row["sexo"];
			$direccion = $row["direccion"];
			$domicilio = $row["direccion"];
			$celular = $row["telefono"];
			$email = trim($row["email"]);
			$telefono = $row["telefono"];
			$recibopago = $row["recibopago"];
			$tipocolegio = $row["tipocolegio"];
			$certificado = $row["certificado"];	
			$fecharegistro =  $row["fecharegistro"];
			$anioegreso =  $row["anioegreso"];
			$colegio =  $row["colegio"];
			$nombredepartamento =  $row["nombredepartamento"];
			$nombreprovincia =  $row["nombreprovincia"];
			$nombredistrito =  $row["nombredistrito"];
			$descripcionmoda =  $row["descripcionmoda"];			
			mysqli_data_seek($rs,0);
		}
	######################
	#######################

	$mpdf->SetHTMLHeader('
	<div style="text-align: right; font-weight: bold;">
		<table style="autosize:2.4;">
			<tr>
				<td width="10%" align="center">
					<img src="../images/logo_ingreso.jpg" width="90" />
				</td>
				<td align="center">
					<span style="font-size:22px; font-weight:bold">UNIVERSIDAD NACIONAL AUTONOMA DE TAYACAJA</span>
					<br>
					<span style="font-size:22px; font-weight:bold">DANIEL HERN&Aacute;NEZ MORILLO</span>
					<br>
					<span style="font-size:12px;">(Creada por Ley Nro. 29716)</span>
					<br>
					<br>
					<span style="font-size:20px; font-weight:bold">OFICINA DE ADMISI&Oacute;N</span>
					<br>
				</td>
				<td width="15%" align="center">
					<table width="100%" border="0">
						<tr>
							<td height="120" align="center" style="bborder-right:thin; border-left:thin; border-bottom:thin; border-top:thin;">'.
							 mostrarfoto_postulante_carne($numerodocumento).
							'</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>		
	</div>'
	);
	
	#$mpdf->SetHTMLFooter('
	#<table width="100%">
	#	<tr>
	#		<td width="33%">{DATE j-m-Y}</td>
	#		<td width="33%" align="center">{PAGENO}/{nbpg}</td>
	#		<td width="33%" style="text-align: right;">My document</td>
	#	</tr>
	#</table>
	#');
	
	
	if ($email=='')
		{
			$email='(x)';	
		}	
	
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<div style="text-align: center; font-weight: bold;">'.
		$titulo.
		'</div>
	');
	
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>'.
		$v2.
		'
	');
	$mpdf->Output();

?>
