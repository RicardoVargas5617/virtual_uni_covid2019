<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include_once "../config.php";
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	include('../funciones/admi_fun_admision.php');
	require_once GL_DIR_FS_APP.'vendor/autoload.php';
	ini_set('display_errors', '1');
	###################################################
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");	
	###################################################
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);		
	$nombreproceso = nombreproceso($proceso);
	$macro = nombremacro($proceso);
	
	#####################################
	$mpdf = new \Mpdf\Mpdf();
	#####################################
	
	require_once('adm_post_total0.php');
	require_once('adm_post_total1.php');
	require_once('adm_post_total2.php');
	require_once('adm_post_total3.php');
	require_once('adm_post_total4.php');
	require_once('adm_post_total5.php');
	
	$mpdf->SetHTMLHeader('
	<div style="text-align: center; font-weight: bold;">
		<table width="750" border="0">
			<tr>
				<td width="15%" align="center">
					<img src="../images/logo_ingreso.jpg" width="90" />
				</td>
				<td align="center">
					<span style="font-size:18px; font-weight:bold">UNIVERSIDAD NACIONAL JOSE MARIA ARGUEDAS</span>
					<br>
					<br>
					<span style="font-size:18px; font-weight:bold">OFICINA DE ADMISI&Oacute;N</span>
					<br>
				</td>
				<td width="15%" align="center">'.
					$fotex.
				'</td>
			</tr>
		</table>
	</div>'
	);
	
	$mpdf->SetHTMLFooter('
	<table width="100%" border="0">
		<tr>
			<td align="center">
        		<img src="../imageneszet/logopie.jpg" />
        	</td>
    	</tr>
	</table>
	');

	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$vc.
		'<br>'.
		$v2.
		$v3.
		''
		);
	
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$vc1.
		'<br>'.
		$v21.
		'<br><br>'.
		$v3.
		''
		);
		
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$vc2.
		'<br>'.
		$v22.
		$v3.
		$v4.
		''
		);		
		
	$mpdf->SetHTMLHeader('
	<div style="text-align: center; font-weight: bold;">
		<table width="750" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="10%" align="center">
					<img src="../imageneszet/logocabecera.jpg" />
				</td>
			</tr>
		</table>
		<table width="750">
			<tr>
				<td align="center">
					<span style="font-size:12px; font-weight:bold">
					"A&ntilde;o de la universalizaci&oacute;n de la Salud"
					</span>
				</td>
			</tr>
		</table>
	</div>'
	);
	
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$a1_1.
		'<br>'.
		$a1_2.
		'<br>'.
		'<br>'.
		'<br>'.
		$a1_3.
		''
		);	
		
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$a2_1.
		'<br>'.
		$a2_2.
		'<br>'.
		'<br>'.
		'<br>'.
		$a1_3.
		''
		);	
		
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$a3_1.
		'<br>'.
		$a3_2.
		'<br>'.
		'<br>'.
		$a1_3.
		''
		);			
		
		
	$mpdf->Output();
?>
