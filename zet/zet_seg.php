<?php	
    $a = validar_d($d, $persona, $usuario, $vperfil);
	#echo $a;
	#exit;
	if ($a<>2)
		{
			#header("location:index.php");
			echo 'Error... no tiene permisos';
			exit;	
		}
	if (trim($usuario)=='' or trim($persona)=='' or trim($vperfil)=='')
		{
			#header("location:index.php");
			echo 'Error... no tiene permisos';
			exit;	
		}
?>