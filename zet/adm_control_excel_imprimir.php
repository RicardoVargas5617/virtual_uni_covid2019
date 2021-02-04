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
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$proceso = substr($codigo,0,4);
	$supervisor = substr($codigo,4,8);
	header('Content-type: application/vnd.ms-excel;');
	header("Content-Disposition: attachment; filename=postulantes.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$vsql = "call zoz_CAControl ('". $proceso . "', '". $supervisor . "','',0,'C')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	$num= mysqli_num_rows($rs); 	
	if ($num > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$nombresupervisor = $row["nombresupervisor"];
			$aulavirtual = $row["aulavirtual"];
			$ambiente = $row["ambiente"];
			mysqli_data_seek($rs,0);
		}
	else
		{
			$nombresupervisor='';
			$aulavirtual='';
			$ambiente = '';
			exit;
		}
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
		<td align="center" colspan="7">
			<strong>POSTULANTES <?php echo $nombreproceso;?></strong>
        </td>
	</tr>
</table>
<table>
	<tr>
    	<td colspan="3">
        	<strong>
            Supervisor: <?php echo $nombresupervisor?>
            </strong>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<strong>
            Aula virtual <?php echo substr($ambiente,3) ?>: &nbsp;&nbsp;<?php echo $aulavirtual?>
            </strong>
        </td>
    </tr>
</table>
<table border="1">
	<tr>
    	<td align="center"><strong>Nro.</strong></td>
    	<td align="center"><strong>C&oacute;digo</strong></td>	
        <td align="center"><strong>Clave</strong></td>	
    	<td align="center"><strong>Apellidos y Nombres</strong></td>
    	<td align="center"><strong>Escuela</strong></td>
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
				echo $rsjk[3];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[16];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[4];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[11];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[5];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[6];
			echo '</td>';			
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>