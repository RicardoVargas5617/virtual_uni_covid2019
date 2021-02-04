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
	$estructura = substr($codigo,4,2);
	$modalidad = substr($codigo,6,2);
	$nombreproceso = nombreproceso($proceso);
	$nombreescuela = nombreescuela($estructura);
	
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '". $estructura . "','". $modalidad . "', '56')";
	$rs = mysqli_query($cn_zet, $vsql);
	
	#$t_a = 'APTITUD MATEMATICA';
	#$t_b = 'APTITUD VERBAL';
	
	$t_a = 'APTITUD ACADÉMICA';
	$t_b = 'CONOCIMIENTOS';

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
				<td width="15%" align="center">
					
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

	$tit = $nombreescuela;
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
				<td width="5%" rowspan="2" align="center" style="font-size:12px;"><strong>Nro.</strong></td>
				<td width="7%" rowspan="2" align="center" style="font-size:12px;"><strong>C&oacute;digo</strong></td>	
				<td rowspan="2" align="center" style="font-size:12px;"><strong>Apellidos y Nombres</strong></td>
				<td width="12%" colspan="3" align="center" style="font-size:12px;"><strong>'.
				$t_a.
				'</strong></td>
				<td width="12%" colspan="3" align="center" style="font-size:12px;"><strong>'.
				$t_b.				
				'</strong></td>
				<td width="6%" rowspan="2" align="center" style="font-size:12px;"><strong>Puntaje</strong></td>
				<td width="20%" rowspan="2" align="center" style="font-size:12px;"><strong>Especialidad</strong></td>
				<td width="10%" rowspan="2" align="center" style="font-size:12px;"><strong>Condici&oacute;n</strong></td>
			</tr>
			<tr>
			  <td align="center" style="font-size:12px;">Bu</td>
			  <td align="center" style="font-size:12px;">Ma</td>
			  <td align="center" style="font-size:12px;">Puntaje</td>
			  <td align="center" style="font-size:12px;">Bu</td>
			  <td align="center" style="font-size:12px;">Ma</td>
			  <td align="center" style="font-size:12px;">Puntaje</td>
		  </tr>';
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		$v.= '<tr>';
			$v.=  '<td align="center" style="font-size:11px;">';
				$v.=  $contador;
			$v.=  '</td>';
			$v.=  '<td align="center" style="font-size:11px;">';
				$v.=  $rsjk[0];
			$v.=  '</td>';
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.=  $rsjk[1];
			$v.=  '</td>';
			$v.=  '<td align="right" style="font-size:11px;">';
				$v.= $rsjk[2];
			$v.=  '</td>';
			$v.= '<td align="right" style="font-size:11px;">';
				$v.=  $rsjk[3];
			$v.=  '</td>';
			$v.=  '<td align="right" style="font-size:11px;">';
				$v.=  $rsjk[4];
			$v.=  '</td>';
			$v.=  '<td align="right" style="font-size:11px;">';
				$v.=  $rsjk[5];
			$v.=  '</td>';
			$v.=  '<td align="right" style="font-size:11px;">';
				$v.=  $rsjk[6];
			$v.=  '</td>';
			$v.=  '<td align="right" style="font-size:11px;">';
				$v.=  $rsjk[7];
			$v.=  '</td>';
			$v.=  '<td align="right" style="font-size:11px;">';
				$v.=  '<strong style="font-size:12px;">'.$rsjk[8].'</strong>';
			$v.=  '</td>';			
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.=  $rsjk[9];
			$v.=  '</td>';			
			$v.=  '<td align="left" style="font-size:11px;">';
				$v.=  $rsjk[10];
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
