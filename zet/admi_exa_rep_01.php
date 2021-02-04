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
	$cn = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$proceso = base64_decode(base64_decode($_GET['proceso']));
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', 'R1')";
	##echo $vsql;
	$rs = mysqli_query($cn, $vsql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>POSTULANTES ASISTENTES</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 10px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
.zet10 {
	font-size: 9px;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 
	$titulo = 'POSTULANTE ACTIVOS';
?>
<table width="750" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="10%" align="center">
        	<img src="../images/logo_ingreso.jpg" width="80" />
        </td>
        <td align="center">
        	<span style="font-size:24px; font-weight:bold">Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas</span>
            <br>
            <span style="font-size:16px; font-weight:bold">
			<?php 
			echo $nombreproceso;
			echo '<br>';
			echo $titulo;			
			?>
            </span>
        </td>
	</tr>
</table>
<br>
</table>
<table width="750" border="1">
	<tr>
    	<td width="5%" align="center"><strong>Nro.</strong></td>
    	<td align="center"><strong>Apellidos y nombres</strong></td>	
    	<td width="35%" align="center"><strong>Carrera</strong></td>
	</tr>
	<?php
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		echo '<tr>';
			echo '<td align="center">';
				echo $contador;
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[3];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[4];
			echo '</td>';	
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>