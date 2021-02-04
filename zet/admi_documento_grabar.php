<?php
	#echo 'hola';
	$status = "";
	$codigo = $_POST['codigo'];
	$d = $_POST['d'];
	$nav = $_POST['nav'];
	$semestre = substr($codigo,3,6);
	#echo $d;
	#echo $nav;
	#exit;
	if ($_POST["action"] == "upload") 
	{
		// obtenemos los datos del archivo 
		$tamano = $_FILES["archivo"]['size'];
		$tipo = $_FILES["archivo"]['type'];
		$archivo = $_FILES["archivo"]['name'];	
		if ($archivo != "") 
		{
			// guardamos el archivo a la carpeta ficheros
			$destino= "../foto_documento/".$codigo.".pdf";
			//.".jpg"
			echo $destino;
			if (copy($_FILES['archivo']['tmp_name'],$destino)) 
			{
				$status = "Archivo subido";
			} 
			else 
			{
				$status = "Error al subir el archivo";
				$msg='Error';
			}
		} 
	}
	echo $status;
	#echo 'hola';
?>