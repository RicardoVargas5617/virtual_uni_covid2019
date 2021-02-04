<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	require_once('sessiones.php');
	include('../funciones/admi_con.php');
	include('../funciones/unajma_admision.php');
	set_time_limit(0);
	$cn = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$proceso = $_GET['codigo'];
	header('Content-type: application/vnd.ms-excel;');
	header("Content-Disposition: attachment; filename=postulantes.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '10')";
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>POSTULANTES</title>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php
	include('../funciones/admi_fun.php');
	$nombreproceso = nombreproceso($proceso);
	#echo $vsql;
?>
<table>
	<tr>
		<td align="center" colspan="21">
			<strong><?php echo $nombreproceso;?></strong>
        </td>
	</tr>
</table>
<table border="1">
  <tr>
    <td><strong>Nro.</strong></td>
    <td align="center"><strong>C&oacute;digo</strong></td>
    <td align="center"><strong>Apellido Paterno</strong></td>
    <td align="center"><strong>Apellido Materno</strong></td>    
    <td align="center"> <strong>Nombre</strong></td>
    <td align="center"><strong>Escuela</strong></td>
    <td align="center"><strong>Modalidad</strong></td>
    <td align="center"><strong>Fecha Nacimiento</strong></td>
	<td align="center"><strong>Tipo Documento</strong></td>
    <td align="center"><strong>Numero Documento</strong></td>
    <td align="center"><strong>Sexo</strong></td>
    <td align="center"><strong>Direcci&oacute;n</strong></td>
    <td align="center"><strong>Tel&eacute;fono</strong></td>
    <td align="center"><strong>Email</strong></td>
    <td align="center"><strong>Veces UNAJMA</strong></td>
    <td align="center"><strong>Veces Otra</strong></td>
    <td align="center"><strong>Procedencia</strong></td>
    <td align="center"><strong>Tipo Colegio</strong></td>
    <td align="center"><strong>Tipo Pago</strong></td>
    <td align="center"><strong>Recibo Pago</strong></td>
    <td align="center"><strong>A&ntilde;o egreso</strong></td>
    <td align="center"><strong>Colegio</strong></td>
    <td align="center"><strong>Ubigeo</strong></td>
  </tr>
	<?php
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		echo '<tr>';
			echo '<td align="right">';
				echo $contador;
			echo '</td>';
			echo '<td align="left">';
				echo '&nbsp;'.generar_codigo_u($rsjk[0]);
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
			echo '<td align="left">';
				echo $rsjk[5];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[6];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[7];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[8];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[9];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[10];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[11];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[12];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[13];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[14];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[15];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[16];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[17];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[18];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[19];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[24];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[25];
			echo '</td>';
		echo '</tr>';		 
  	}
	?>  	
</table>
</body>
</html>