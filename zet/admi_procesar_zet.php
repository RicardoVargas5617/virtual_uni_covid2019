<?php 
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	require_once('sessiones.php');
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	set_time_limit(0);	
	$cn_zoz = conectar();
	$proceso = $_GET['proceso'];
	
	$vsqlproceso = "call zyz_Admi_Resultado ('". $proceso . "', '','Z')";	
	#mysqli_query($cn_zoz, strtoupper($vsql));
	#echo $vsqlproceso;
	#exit;
	$rs = mysqli_query($cn_zoz, $vsqlproceso);
	echo 'Se procesó correctamente';
?>