<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$proceso = $_GET['codigo'];
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '01')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
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
	$titulo = $nombreproceso . ' - LISTADO GENERAL DE POSTULANTES';
	require ('cabecera_admision.php')
?>
<table width="1200" border="1">
	<tr>
    	<td width="5%" align="center"><strong>Nro.</strong></td>
        <td width="10%" align="center"><strong>Foto</strong></td>
    	<td align="center"><strong>Apellidos y Nombres</strong></td>
 		<td width="6%" align="center"><strong>Dni</strong></td>
        <td width="6%" align="center"><strong>Fecha Nac.</strong></td>
        <td width="12%" align="center"><strong>Domicilio</strong></td>
    	<td width="14%" align="center"><strong>Escuela</strong></td>
    	<td width="6%" align="center"><strong>Tipo Colegio</strong></td>
    	<td width="10%" align="center"><strong>Colegio</strong></td>
        <td width="3%" align="center"><strong>Egreso</strong></td>
        <td width="8%" align="center"><strong>Modalidad</strong></td>
        <td width="5%" align="center"><strong>Pagos</strong></td>
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
				mostrarfoto_postulante_mini($rsjk[6]);
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[2];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[6];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[8];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[9];
			echo '</td>';
			echo '<td align="left">';
				echo $rsjk[3];
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
			echo '<td align="right">';
				echo $rsjk[14];
			echo '</td>';
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>