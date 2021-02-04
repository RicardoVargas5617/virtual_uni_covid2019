<?php 
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	require_once('sessiones.php');
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	$cnzet = conectar();
	$cnver = conectar();
	$proceso = $_POST['proceso'];
	
	set_time_limit(0);
	
	$archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
		
	if ($archivo) {
   	$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
   	$extension = strtolower($extension);
   	$extension_correcta = ($extension == 'dat');
		if ($extension_correcta) {
		 $ruta_destino_archivo = "../admision/{$archivo['name']}";
		  $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
		}
	}	
	else
		{
			echo 'error';
			exit;	
		}
	$contador=0;
	#echo $ruta_destino_archivo;
	#exit;
	$vsql = "delete from adm_importar_clave";
	#echo $vsql;
	#exit;
	mysqli_query($cn, $vsql);
	#mysqli_close($cn);

	$fprespuesta = fopen($ruta_destino_archivo,'r');	
	while(!feof($fprespuesta))  
			{
					$order = fgets($fprespuesta,170);					
					$contador = $contador+1;
					#if ($contador<=2)
					if ($contador<=2) 
					{
						$vsql = "insert into adm_importar_clave (proceso, orden) values('$proceso', '$order')";			
						mysqli_query($cnzet, $vsql);							
					}
			}
	fclose($fprespuesta);

	$vsql = "call zyz_CAImportarClave('". $usuario . "','". $persona . "','". $proceso . "')";
	#echo $vsql;
	#exit;
	$rs = mysqli_query($cnver, $vsql);
	echo 'Se procesó correctamente';
?>