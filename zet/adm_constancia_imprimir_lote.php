<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include_once "../config.php";	
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	require_once GL_DIR_FS_APP.'vendor/autoload.php';	
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$tipito = substr($codigo,4,1);
	$pos = substr($codigo,5,7);
	$nombreproceso = nombreproceso($proceso);
	$contador = 0;

	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','". $pos . "', '". $tipito . "', '', 'I')";
	$rs_zet = mysqli_query($cn_zet, $vsql);
	$numeroregistros = mysqli_num_rows($rs_zet); 	
	#echo $vsql;
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs_zet, MYSQLI_ASSOC);
			$numerodocumento = $row["numerodocumento"];
			$nombrecompleto = $row["nombrecompleto"];
			$escuela = $row["escuela"];
			$modalidad = $row["modalidad"];
			$puntaje = $row["puntaje"];
			$sede = $row["sede"];
			$puesto = $row["puesto"];
			#$res = $row["res"];
			#$fechita = $row["fechita"];
			#$responsable = $row["responsable"];
			#$descripcion = $row["descripcion"];
			#$proceso = $row["proceso"];
			#$nombreproceso = $row["nombreproceso"];
			#$moda = $row["moda"];
		}	

	#####################################
	#$mpdf = new \Mpdf\Mpdf();
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
	#####################################
	$cabecera='<table width="100%" border="0">
			<tr>
				<td align="center">
					<img src="../images/cabecera.jpg" width="650" />
				</td>				
			</tr>
		</table>';
	#####################################
	$mpdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td style="text-align: center;">
				Jr. Juan Francisco Ramos N° 380, Andahuaylas, Apurímac
				<br>
				www.unajma.edu.pe
				</td>
			</tr>
		</table>
	');

	$tit = '"Año de la universalizaci&oacute;n de la salud"';
	$titulo ='
	<table width="100%">
		<tr>
			<td align="center" style="font-size:14px;font-weight:bold">'.
				$tit.				
			'</td>
		</tr>
		<tr>
			<td align="center" style="font-size:22px;font-weight:bold">
				<br>
				<br>
				<br>
				<u>CONSTANCIA DE INGRESO</u>				
			</td>
		</tr>
	</table>
	<br>
	<table width="100%">
		<tr>
			<td width="10%">
			
			</td>
			<td style="font-size:16px;" align="center">
				LA OFICINA CENTRAL DE ADMISIÓN DE LA UNIVERSIDAD NACIONAL JOSÉ MARÍA ARGUEDAS				
			</td>
			<td width="10%">
			
			</td>
		</tr>
	</table>'	
	;
	
	$v = '
	<br>
	<br>
	<table width="100%">
		<tr>
			<td width="10%">
			
			</td>
			<td style="font-size:14px;font-weight:bold" align="left">
				<u>HACE CONSTAR</u>				
			</td>
			<td width="10%">
			
			</td>
		</tr>
		<tr>
			<td width="10%">
			
			</td>
			<td style="line-height: 30px; font-size:14px;text-align: justify">
				<br>
				Que, <strong>'.
					$nombrecompleto
					.
					',</strong> con DNI Nro. <strong>'.
					$numerodocumento
					.
					'</strong> y código de postulante <strong>'.
					$numerodocumento
					.
					',</strong> logró su ingreso a la Escuela Profesional de <strong>'.
					$escuela
					.
					',</strong>  ubicada en la sede de '.
					$sede	
					.
					', por la modalidad <strong>'.
					$modalidad
					.
					', </strong> en el puesto <strong>'.
					$puesto
					.
					',</strong> con puntaje de <strong>' .
					$puntaje
					.
					', </strong>iniciando sus estudios en el semestre académico 2020-II, así consta en los archivos de la oficina.
					<br>
					<br>					
					Se expide la presente a solicitud del interesado, para los fines que estime conveniente.
					<br><br><br>  				
			</td>
			<td width="10%">
			
			</td>
		</tr>
		</table>
		<table width="100%">
				<tr>
					<td width="10%">
			
					</td>
					<td style="line-height: 30px; font-size:14px;" align="right">
						<span>
						Andahuaylas, 06 de octubre del 2020
						</span>
					</td>
					<td width="10%">
			
					</td>
				</tr>		
				<tr>
					<td colspan="3" align="center">
						<br>
						<img src="../images/jefeora.jpg" width="200">
					</td>
				</tr>
		</table>';	

	$mpdf->WriteHTML(
		$cabecera.
		$titulo.
		'<br>'.
		$v.
		'<br>'
		);
		
	$mpdf->Output();
?>  