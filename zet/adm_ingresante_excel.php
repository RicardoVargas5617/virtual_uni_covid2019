<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	$codigo = $_GET['codigo'];
	$proceso = base64_decode(base64_decode($codigo));
	header('Content-type: application/vnd.ms-excel;');
	header("Content-Disposition: attachment; filename=postulantes.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '04')";
	#echo $vsql;
	$rs = mysqli_query($cn_zet, $vsql);
	#mysqli_close($cn);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>POSTULANTES</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 11px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
.zet10 {
	font-size: 13px;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 	
	include('../funciones/admi_fun.php');
	$nombreproceso = nombreproceso($proceso);
	$titulo = 'PADRON GENERAL DE INGRESANTES';
?>
<table>
	<tr>
    	<td colspan="9" align="center">
        	<?php echo $nombreproceso;?>
        </td>
    </tr>
    <tr>
    	<td colspan="9" align="center">
        	<?php echo $titulo;?>
        </td>
    </tr>
</table>
<table border="1">
	<tr>
    	<td align="center"><strong>Nro.</strong></td>
    	<td align="center"><strong>C&oacute;digo</strong></td>	
    	<td align="center"><strong>Apellidos y Nombres</strong></td>
    	<td align="center"><strong>Escuela</strong></td>
    	<td align="center"><strong>Modalidad</strong></td>
        <td align="center"><strong>Buenas</strong></td>
        <td align="center"><strong>Malas</strong></td>
    	<td align="center"><strong>Puntaje</strong></td>
        <td align="center"><strong>Condici&oacute;n</strong></td>
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
			echo '<td align="right">';
				echo $rsjk[5];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[6];
			echo '</td>';		
			echo '<td align="right">';
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