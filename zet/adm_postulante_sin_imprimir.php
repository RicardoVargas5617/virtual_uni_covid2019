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
	$cn = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$proceso = base64_decode(base64_decode($_GET['codigo']));
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '00')";
	$rs = mysqli_query($cn, $vsql);
	#echo $vsql;
	##############################
	#table { 
    #border-collapse: collapse; 
    #border-spacing: 0; 
	#	}
	#thead, tr, th, td { 
    #margin: 0; 
    #padding: 0; 
    #border: 0; 
    #outline: 0; 
    #font-size: 100%; 
    #vertical-align: baseline; 
    #background: transparent; 
	#} 	 
	#####################################
	#$mpdf = new \Mpdf\Mpdf();
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
	#####################################
	$cabecera='<table width="100%" border="0">
			<tr>
				<td width="15%" align="center">
					<img src="../images/logo_ingreso.jpg" width="90" />
				</td>
				<td align="center">
					<span style="font-size:18px; font-weight:bold">UNIVERSIDAD NACIONAL JOSE MARIA ARGUEDAS</span>
					<br>
					<span style="font-size:18px; font-weight:bold">OFICINA DE ADMISI&Oacute;N</span>
				</td>
			</tr>
		</table>';
	#####################################
	$mpdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td style="text-align: right;">{PAGENO}/{nbpg}</td>
			</tr>
		</table>
	');

	$tit = 'LISTADO GENERAL DE POSTULANTES (SIN VALIDAR)';
	$titulo ='
	<table width="100%">
		<tr>
			<td align="center" style="font-size:14px;font-weight:bold">'.
				$nombreproceso.				
			'</td>
		</tr>
		<tr>
			<td align="center" style="font-size:14px;font-weight:bold">'.
				$tit.				
			'</td>
		</tr>
	</table>';

	$v = '
		<table width="100%" border="1" style="border-collapse:collapse;">
			<tr>
				<td width="5%" align="center" style="font-size:12px;"><strong>Nro.</strong></td>
				<td width="9%" align="center" style="font-size:12px;"><strong>C&oacute;digo</strong></td>	
				<td align="center" style="font-size:12px;"><strong>Apellidos y Nombres</strong></td>
				<td width="30%" align="center" style="font-size:12px;"><strong>Escuela</strong></td>
				<td width="20%" align="center" style="font-size:12px;"><strong>Modalidad</strong></td>
				<td width="10%" align="center" style="font-size:12px;"><strong>Observaci&oacute;n</strong></td>
			</tr>
		';
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		$v.= '<tr>';
			$v.= '<td align="center" style="font-size:11px;">';
				$v.= $contador;
			$v.=  '</td>';
			$v.=  '<td align="center" style="font-size:11px;">';
				$v.=  $rsjk[6];
			$v.=  '</td>';
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.=  $rsjk[2];
			$v.=  '</td>';
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.= $rsjk[3];
			$v.=  '</td>';
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.=  $rsjk[4];
			$v.=  '</td>';
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.=  '';
				#$v.=  $rsjk[5];
			$v.=  '</td>';			
		$v.=  '</tr>';			
  	}
	$v.= '</table>';

	$mpdf->WriteHTML(
		$cabecera.
		$titulo.
		'<br>'.
		$v.
		'<br>'
		);
		
	$mpdf->Output();
?>  