<?php 
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	require_once('sessiones.php');
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$proceso = $_GET['proceso'];
	$cn = conectar();
?>
<html>
<head>
<title>Subir identificacion</title>
<!-- Juliozet -->
<meta name="KEYWORDS" content="Sistema academico, juliozet@hotmail.com, siga TELESUP, siga web, juliozet, julio c&eacutesar alvarez reyes, siga, juliozet">
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo $vcolacion?>">
</head>
<body>                                      
   <form method="post" action="adm_leer_identificacion_procesar.php" enctype="multipart/form-data">
      <label> Archivo </label>
      <input type="hidden" name="proceso" value=<?php echo $proceso?> />
      <input type="file" name="archivo" required="required" />
      <input type="submit" value="Subir" />
   </form>
</body>
</html>