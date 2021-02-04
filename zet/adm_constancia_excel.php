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
	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','', '','','D')";
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
    	<td align="center" colspan="9">
        	<strong>
            REPORTE GENERAL DE INGRESANTES
            </strong>
        </td>
    </tr>
</table>
<table border="1">
  <tr>
    <td><strong>Nro.</strong></td>
    <td align="center"><strong>Proceso</strong></td>
    <td align="center"><strong>Postulante</strong></td>    
    <td align="center"> <strong>Numero de documento</strong></td>
    <td align="center"> <strong>Nombre completo</strong></td>
    <td align="center"><strong>Escuela</strong></td>
    <td align="center"><strong>Modalidad</strong></td>
    <td align="center"><strong>Email</strong></td>
    <td align="center"><strong>Telefono</strong></td>
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
				echo '&nbsp;'.$rsjk[0];
			echo '</td>';
			echo '<td align="left">';
				echo '&nbsp;'.$rsjk[1];
			echo '</td>';
			echo '<td align="left">';
				echo '&nbsp;'.$rsjk[2];
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
		echo '</tr>';		 
  	}
	?> 	
</table>
</body>
</html>