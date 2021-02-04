<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$estructura = substr($codigo,4,2);
	$modalidad = substr($codigo,6,2);
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '". $estructura . "','". $modalidad . "', '56')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
	$nombreescuela = nombreescuela($estructura);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>POSTULANTES</title>
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
	$titulo = 'RESULTADOS '. $nombreproceso;
	require ('cabecera_admision_horizontal.php')
?>
<table width="1200">
	<tr>
    	<td align="center">
        	<strong style="font-size:16px">
            <?php echo $nombreescuela;?>
            </strong>
        </td>
    </tr>
</table>
<br>
<table width="1200" border="1">
	<tr>
    	<td width="5%" rowspan="2" align="center"><strong>Nro.</strong></td>
    	<td width="7%" rowspan="2" align="center"><strong>C&oacute;digo</strong></td>	
    	<td rowspan="2" align="center"><strong>Apellidos y Nombres</strong></td>
    	<td width="12%" colspan="3" align="center"><strong>Aptitud Matem&aacute;tica</strong></td>
    	<td width="12%" colspan="3" align="center"><strong>Aptitud Verbal</strong></td>
    	<td width="6%" rowspan="2" align="center"><strong>Puntaje</strong></td>
        <td width="20%" rowspan="2" align="center"><strong>Especialidad</strong></td>
        <td width="10%" rowspan="2" align="center"><strong>Condici&oacute;n</strong></td>
	</tr>
	<tr>
	  <td align="center">Bu</td>
	  <td align="center">Ma</td>
	  <td align="center">Puntaje</td>
	  <td align="center">Bu</td>
	  <td align="center">Ma</td>
	  <td align="center">Puntaje</td>
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
				echo $rsjk[0];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[1];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[2];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[3];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[4];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[5];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[6];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[7];
			echo '</td>';
			echo '<td align="right">';
				echo '<strong style="font-size:12px;">'.$rsjk[8].'</strong>';
			echo '</td>';			
			echo '<td align="left">';
				echo $rsjk[9];
			echo '</td>';			
			echo '<td align="left">';
				#echo $rsjk[6];
				echo $rsjk[10];
			echo '</td>';
			#echo '<td align="left">';
			#	echo '<span style="font-size:8px;">';
			#	echo $rsjk[8];
			#	echo '</span>';
			#echo '</td>';			
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>