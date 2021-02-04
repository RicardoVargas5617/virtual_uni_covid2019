<?php
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	echo 'hola1';
	include('../funciones/admi_fun_admision.php');
	include('../funciones/admi_fun_con.php');
	$codigo = $_GET['codigo'];
	echo 'hola2';
	generar_siga_zet($codigo);
	$file='../exportar/exporta_siga.txt';
	header("Content-disposition: attachment; filename=\"$file\"");
	header("Content-type: application/octet-stream");
	readfile($file);
?>