<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$estructura = substr($codigo,4,2);
	$modalidad = substr($codigo,6,2);
	$nombreproceso = nombreproceso($proceso);
	$nombreescuela = nombreescuela($estructura);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '". $estructura . "','". $modalidad . "', '46')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
	#$titulo = $nombreproceso . ' - PADRON GENERAL';	
	$titulo = 'RESULTADOS ' . $nombreproceso.'<br>'.$nombreescuela;
	#$titulo = 'RESULTADOS CPUNAT PRIMER SUMATIVO 2020-1 - SEDE CENTRAL PAMPAS'.'<br>'.$nombreescuela;
	#$titulo = 'RESULTADOS CPUNAT PRIMER SUMATIVO 2020-1 - SEDE ANDABAMBA'.'<br>'.$nombreescuela;
	include '../mpdf/mpdf.php';
	$mpdf = new mPDF('','A4-L',0,'',15,15,10,6,9,9, 'L');
	#$mpdf->setFooter('{PAGENO}');
	
	stream_context_set_default(
		array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true,
			)
		)
	);
	
	$mpdf->SetHTMLHeader('
	<div style="text-align: right; font-weight: bold;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="15%" align="center">
					<img src="../imageneszet/unat.png" width="60" />
				</td>
				<td align="center">
					<span style="font-size:24px; font-weight:bold">Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas</span>
					<br>
					<span style="font-size:16px; font-weight:bold">'.$titulo.'</span>
				</td>
			</tr>
		</table>
	</div>','O');
	
	$mpdf->SetHTMLHeader('
	<div style="text-align: right; font-weight: bold;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="15%" align="center">
					<img src="../imageneszet/unat.png" width="60" />
				</td>
				<td align="center">
					<span style="font-size:24px; font-weight:bold">Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas</span>
					<br>
					<span style="font-size:16px; font-weight:bold">'.$titulo.'</span>
				</td>
			</tr>
		</table>
	</div>','E');
	
	$mpdf->SetHTMLFooter('
	<table width="100%">
		<tr>
			<td align="right">{PAGENO}/{nbpg}</td>
		</tr>
	</table>','O');
	
	$mpdf->SetHTMLFooter('
	<table width="100%">
		<tr>
			<td align="right">{PAGENO}/{nbpg}</td>
		</tr>
	</table>','E');
	
	$mpdf->showImageErrors = true;
	$mpdf->mirrorMargins = true;

$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$vcolacion.'" />
<title>CARNE</title>
<style>
body {
	background-color: #FFFFFF; font-size : 11px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
</style>
</head>
<body>
<table width="100%" style="border-collapse: collapse;">
	<tr style="border: 1px solid transparent;">
    	<td style="border: 1px solid transparent;" width="3%" rowspan="2" align="center"><strong>Nro.</strong></td>
    	<td style="border: 1px solid transparent;" width="8%" rowspan="2" align="center"><strong>C&oacute;digo</strong></td>	
    	<td style="border: 1px solid transparent;" rowspan="2" align="center"><strong>Apellidos y Nombres</strong></td>
    	<td style="border: 1px solid transparent;" width="12%" colspan="3" align="center"><strong>Aptitud Académica</strong></td>
    	<td style="border: 1px solid transparent;" width="12%" colspan="3" align="center"><strong>Conocimientos</strong></td>
    	<td style="border: 1px solid transparent;" width="6%" rowspan="2" align="center"><strong>Puntaje</strong></td>
        <td style="border: 1px solid transparent;" width="20%" rowspan="2" align="center"><strong>Especialidad</strong></td>
        <td style="border: 1px solid transparent;" width="10%" rowspan="2" align="center"><strong>Observación</strong></td>
	</tr>
	<tr style="border: 1px solid transparent;">
	  <td style="border: 1px solid transparent;" align="center">Bu</td>
	  <td style="border: 1px solid transparent;" align="center">Ma</td>
	  <td style="border: 1px solid transparent;" align="center">Puntaje</td>
	  <td style="border: 1px solid transparent;" align="center">Bu</td>
	  <td style="border: 1px solid transparent;" align="center">Ma</td>
	  <td style="border: 1px solid transparent;" align="center">Puntaje</td>
  </tr>'.
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		$html.= '<tr style="border: 1px solid transparent;">';
			$html.= '<td style="border: 1px solid transparent;" align="center">';
				$html.=  $contador;
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="center">';
				$html.=  $rsjk[1];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="left">';
				$html.=  $rsjk[2];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  $rsjk[9];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  $rsjk[10];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  $rsjk[11];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  $rsjk[12];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  $rsjk[13];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  $rsjk[14];
			$html.=  '</td>';
			$html.=  '<td style="border: 1px solid transparent;" align="right">';
				$html.=  '<strong style="font-size:12px;">'.$rsjk[5].'</strong>';
			$html.=  '</td>';			
			$html.=  '<td style="border: 1px solid transparent;" align="left">';
				$html.=  $rsjk[3];
			$html.=  '</td>';			
			$html.=  '<td align="left">';
				$html.=  '<span style="font-size:9px;">'.$rsjk[8].'</span>';
			$html.=  '</td>';			
		$html.=  '</tr>';			
  	}  
$html.= '</table>';
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle($proceso);
$mpdf->Output($nombreescuela.'.pdf','I');
ob_end_clean();
?>