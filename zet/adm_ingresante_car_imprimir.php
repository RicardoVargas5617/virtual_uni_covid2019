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
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$estructura = substr($codigo,4,2);
	$modalidadadmision = substr($codigo,6,2);
	$nombreproceso = nombreproceso($proceso);
	$nombreescuela = nombreescuela($estructura);
	$nombremodalidad = nombremodalidadadmision($modalidadadmision);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '". $estructura . "','". $modalidadadmision . "', '09')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>INGRESANTES</title>
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
	$titulo = 'PADR&Oacute;N GENERAL DE INGRESANTES';
	require ('cabecera_admision.php')
?>
<table class="table">
	<tr>
    	<td width="8%">
        	<strong>Proceso:</strong>
        </td>
        <td>
        	<?php echo $nombreproceso; ?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>Escuela:</strong>
        </td>
        <td>
        	<?php echo $nombreescuela; ?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>Modalidad:</strong>
        </td>
        <td>
        	<?php echo $nombremodalidad; ?>
        </td>
    </tr>
</table>
<table width="750" border="1" style="border-collapse:collapse" cellpadding="4">
	<tr>
    	<td width="5%" align="center"><strong>Nro.</strong></td>
    	<td width="9%" align="center"><strong>C&oacute;digo</strong></td>	
    	<td align="center"><strong>Apellidos y Nombres</strong></td>
        <td width="12%" align="center"><strong>Buenas</strong></td>
        <td width="12%" align="center"><strong>Malas</strong></td>
        <td width="12%" align="center"><strong>Puntaje</strong></td>
        <td width="12%" align="center"><strong>Estado</strong></td>
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
			echo '<td align="right">';
				echo $rsjk[3];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[4];
			echo '</td>';
			echo '<td align="right">';
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