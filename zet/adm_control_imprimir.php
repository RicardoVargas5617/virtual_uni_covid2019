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
	$supervisor = substr($codigo,4,8);
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zoz_CAControl ('". $proceso . "', '". $supervisor . "','',0,'C')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
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
	$titulo = $nombreproceso . '<br>LISTADO GENERAL DE POSTULANTES';
	require ('cabecera_admision.php')
?>
<br>
<table width="700">
	<tr>
    	<td width="14%">
        	<strong>
            Supervisor:
            </strong>
        </td>
        <td>
        	<?php echo $nombresupervisor?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>
            Aula virtual <?php echo substr($ambiente,3) ?>:
            </strong>
        </td>
        <td>
        	<?php echo $aulavirtual?>
        </td>
    </tr>
</table>
<br>
<table width="750" border="1">
	<tr>
    	<td width="5%" align="center"><strong>Nro.</strong></td>
    	<td width="9%" align="center"><strong>C&oacute;digo</strong></td>	
        <td width="9%" align="center"><strong>Clave</strong></td>	
    	<td align="center"><strong>Apellidos y Nombres</strong></td>
    	<td width="35%" align="center"><strong>Escuela</strong></td>
        <!--<td width="25%" align="center"><strong>Email</strong></td>-->
        <td width="10%" align="center"><strong>Celular</strong></td>
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
			#echo '<td align="left">';
			#	echo $rsjk[5];
			#echo '</td>';
			echo '<td align="center">';
				echo $rsjk[6];
			echo '</td>';			
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>