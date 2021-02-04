<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	require_once('sessiones.php');
	include('../funciones/admi_con.php');
	set_time_limit(0);
	$cn = conectar();
	$proceso = $_GET['codigo'];
	header('Content-type: application/vnd.ms-excel;');
	header("Content-Disposition: attachment; filename=postulantes.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$vsql = "call zyz_CAProcesoAmbiente ('". $proceso . "','','',0,'1900-01-01','','','S')";
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>PROCESO ADMISIÓN</title>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php
	include('../funciones/admi_fun.php');
	$nombreproceso = nombreproceso($proceso);
	#echo $vsql;
?>
<table>
	<tr>
		<td align="center" colspan="7">
			<strong><?php echo $nombreproceso;?> - DISTRIBUCI&Oacute;N DE AMBIENTES</strong>
        </td>
	</tr>
</table>
<table border="1">
  	<tr>
    	<td align="center"><strong>Orden.</strong></td>
    	<td align="center"><strong>C&oacute;digo</strong></td>	
    	<td align="center"><strong>Ap. Paterno</strong></td>
        <td align="center"><strong>Ap. Materno</strong></td>
    	<td align="center"><strong>Nombres</strong></td>
    	<td align="center"><strong>Carrera Profesional</strong></td>
        <td align="center"><strong>Ambiente</strong></td>
        <td align="center"><strong>Email</strong></td>
        <td align="center"><strong>Celular</strong></td>
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
			echo '<td align="center">';
				echo '&nbsp;'.$rsjk[6];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[1];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[2];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[3];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[4];
			echo '</td>';			
			echo '<td align="center">';
				echo $rsjk[5];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[7];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[8];
			echo '</td>';
		echo '</tr>';	 
  	}
	?>  	
</table>
</body>
</html>