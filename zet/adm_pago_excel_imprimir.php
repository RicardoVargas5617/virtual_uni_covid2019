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
		<td align="center" colspan="12">
			<strong><?php echo $nombreproceso;?></strong>
        </td>
	</tr>
    <tr>
    	<td align="center" colspan="12">
        	<strong>
            REPORTE GENERAL DE RECIBOS DE PAGO DE POSTULANTES
            </strong>
        </td>
    </tr>
</table>
<table border="1">
  <tr>
    <td><strong>Nro.</strong></td>
    <td align="center"><strong>Apellido Paterno</strong></td>
    <td align="center"><strong>Apellido Materno</strong></td>    
    <td align="center"> <strong>Nombre</strong></td>
    <td align="center"><strong>Escuela</strong></td>
    <td align="center"><strong>Modalidad</strong></td>
    <td align="center"><strong>Numero Documento</strong></td>
    <td align="center"><strong>Tipo Colegio</strong></td>
    <td align="center"><strong>Fecha registro</strong></td>
    <td align="center"><strong>Tipo Pago</strong></td>
    <td align="center"><strong>Recibo Pago</strong></td>
	<td align="center"><strong>Pago 1</strong></td>
    <td align="center"><strong>Pago 2</strong></td>
  </tr>
	<?php
	$contador = 0;
	$total1 = 0;
	$total2 = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		$total1 = $total1 + $rsjk[20];
		$total2 = $total2 + $rsjk[21];
		echo '<tr>';
			echo '<td align="right">';
				echo $contador;
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
				echo $rsjk[8];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[16];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[23];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[17];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[18];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[20];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[21];
			echo '</td>';
		echo '</tr>';		 
  	}
	?> 
    <tr>
    	<td colspan="11" align="right">
        	<strong>TOTAL</strong>
        </td>
        <td align="right">
        	<strong>
        	<?php echo $total1; ?>
            </strong>
        </td>
        <td align="right">
        	<strong>
        	<?php echo $total2; ?>
            </strong>
        </td>
    </tr> 	
</table>
</body>
</html>