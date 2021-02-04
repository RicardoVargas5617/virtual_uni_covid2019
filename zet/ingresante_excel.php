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
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	header('Content-type: application/vnd.ms-excel;');
	header("Content-Disposition: attachment; filename=postulantes.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','', '','','F')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	$num= mysqli_num_rows($rs); 	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
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
		<td align="center" colspan="7">
			<strong>INGRESANTES</strong>
        </td>
	</tr>
</table>
<table border="1">
	<tr>
    	<td align="center"><strong>Nro.</strong></td>
    	<td align="center"><strong>C&oacute;digo</strong></td>	
        <td align="center"><strong>Apellido Paterno</strong></td>	
    	<td align="center"><strong>Apellido Materno</strong></td>
    	<td align="center"><strong>Nombre</strong></td>
        <td align="center"><strong>Modalidad</strong></td>
        <td align="center"><strong>Carrera</strong></td>
        <td align="center"><strong>Sexo</strong></td>
        <td align="center"><strong>Fecha Nacimiento</strong></td>
        <td align="center"><strong>Email</strong></td>
        <td align="center"><strong>Celular</strong></td>
        <td align="center"><strong>Ubigeo</strong></td>
        <td align="center"><strong>Direcci&oacute;n</strong></td>
        <td align="center"><strong>Apoderado</strong></td>
        <td align="center"><strong>Tipo colegio</strong></td>
        <td align="center"><strong>Ubigeo tipo colegio</strong></td>
        <td align="center"><strong>Colegio</strong></td>
        <td align="center"><strong>Egreso</strong></td>
        <td align="center"><strong>Ubigeo procedencia</strong></td>
        <td align="center"><strong>Puesto</strong></td>
        <td align="center"><strong>Puntaje</strong></td>
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
				echo $rsjk[0];
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
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>