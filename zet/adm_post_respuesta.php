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
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);	
	
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','',0,0,'','','','','','','',0,0,0,0,0,'00','00','00','','',0,0,'','1','2','3','4','5','6','7','I')";	
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			$nombrecompleto = $row["nombrecompleto"];
			$nombreescuela = $row["nombreescuela"];
			mysqli_data_seek($rs,0);
		}	
	$puntaje=0;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>EXAMEN</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 11px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
.zet9 {
	font-size: 11px;
}
.zet16 {
	font-size: 16px;
	font-weight:bold;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 
	$titulo = $nombreproceso . ' - RESPUESTAS';
	require ('cabecera_admision.php')
?>
<table>
	<tr>
    	<td width="10%">
        	<strong>C&oacute;digo:</strong>
        </td>
        <td>
        	<?php echo $postulante?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>Postulante:</strong>
        </td>
        <td>
        	<?php echo $nombrecompleto?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>Carrera:</strong>
        </td>
        <td>
        	<?php echo $nombreescuela?>
        </td>
    </tr>
</table>
<br>
* Cor = Respuesta Correcta
<br>
* Res = Respuesta del postulante
<br>
<br>
<table width="750" border="1">
	<tr>
    	<td width="5%" align="center"><strong>Nro.</strong></td>
	    <!--<td width="16%" align="center"><strong>Tipo</strong></td>-->
        <td width="8%" align="center"><strong>Codigo</strong></td>
        <td align="center"><strong>Pregunta</strong></td>
        <td width="5%" align="center"><strong>Cor</strong></td>
    	<td width="5%" align="center"><strong>Res</strong></td>
    	<td width="5%" align="center"><strong>Valor</strong></td>
	</tr>
	<?php
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		$puntaje = $puntaje + $rsjk[7];
		echo '<tr>';
			echo '<td align="center">';
				echo $contador;
			echo '</td>';
			#echo '<td align="center">';
			#	echo $rsjk[3];
			#echo '</td>';
			echo '<td align="center">';
				echo $rsjk[4];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[20];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[5];
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[6];
			echo '</td>';
			echo '<td align="right">';
				echo $rsjk[7];
			echo '</td>';			
		echo '</tr>';			
  	}
		echo '<tr>';
			echo '<td align="right" colspan="5">';
				echo '<strong>';
					echo 'TOTAL';
				echo '</strong>';	
			echo '</td>';
			echo '<td align="right">';
				echo '<strong>';
					echo $puntaje;
				echo '</strong>';
			echo '</td>';
		echo '</tr>';	
	?>  
</table>
</body>
</html>