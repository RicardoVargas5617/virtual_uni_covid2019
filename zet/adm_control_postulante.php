<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	ini_set("display_errors", 1);
	error_reporting(E_ALL);	
	$cn = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);	
	
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zoz_CAControl ('". $proceso . "', '', '". $postulante . "', 0,'I')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			#echo '1';
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["numerodocumento"];
			$nombrecompleto = $row["nombrecompleto"];
			$nombreescuela = $row["nombreescuela"];
			mysqli_data_seek($rs,0);
		}	
	else
		{
			$postulante = '';
			$nombrecompleto = '';
			$nombreescuela = '';
			echo 'No existen registros relacionados';
			exit;	
		}
	$puntaje=0;
	#echo 'hola';
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
<table width="750">
	<tr>
        <td align="center">
        	<span style="font-size:14px; font-weight:bold;">
        	UNIVERSIDAD NACIONAL JOSE MARIA ARGUEDAS
            </span>
        </td>
    </tr>
</table>
<br>
<table width="750">
	<tr>
    	<td width="10%">&nbsp;
        	
        </td>
        <td align="center">
        	<span style="font-size:14px; font-weight:bold;">
            RESPUESTAS POR POSTULANTE DEL <?php echo $nombreproceso;?>
            </span>
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
</table>
<br>
<br>
<table width="700">
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
<table width="750" border="1" cellspacing="4" style="border-collapse:collapse">
	<tr>
    	<td align="center"><strong>Nro.</strong></td>
        <!--
	    <td width="16%" align="center"><strong>Tipo</strong></td>
        <td width="16%" align="center"><strong>Pregunta</strong></td>
        -->
        <td width="8%" align="center"><strong>Codigo</strong></td>
        <td align="center"><strong>Descripci&oacute;n</strong></td>
        <td width="10%" align="center"><strong>Ip</strong></td>
        <td width="10%" align="center"><strong>Maquina</strong></td>
        <!--<td width="8%" align="center"><strong>Correcta</strong></td>-->
    	<td width="8%" align="center"><strong>Respuesta</strong></td>
    	<!--<td width="7%" align="center"><strong>Valor</strong></td>-->
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
			#echo '<td align="center">';
			#	echo $rsjk[4];
			#echo '</td>';
			echo '<td align="center">';
				echo $rsjk[4];
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
			#echo '<td align="center">';
			#	echo $rsjk[5];
			#echo '</td>';
			echo '<td align="center">';
				echo $rsjk[6];
			echo '</td>';
			#echo '<td align="right">';
			#	echo $rsjk[7];
			#echo '</td>';			
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>