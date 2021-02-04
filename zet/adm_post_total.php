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
	$cnzet = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);		
	$nombreproceso = nombreproceso($proceso);
	$macro = nombremacro($proceso);
	?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>SOLICITUDES</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 12px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
.zet9 {
	font-size: 11px;
}
.zet16 {
	font-size: 16px;
	font-weight:bold;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 
	require_once('adm_post_soli_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_solicitud_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_dj_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_dj_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_aceptacion_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_aceptacion_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_riesgos_one.php');
	echo '<span style="page-break-before:always;"></span>';
	require_once('adm_post_requisitos_one.php');
?>
</body>
</html>
