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
	$ambiente = substr($codigo,4,7);
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAProcesoAmbiente ('". $proceso . "','". $ambiente . "','',0,'1900-01-01','','','','','R')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
	#mysqli_close($cn);
	$num= mysqli_num_rows($rs); 	
	if ($num > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$nombresupervisor = $row["nombresupervisor"];
			$aulavirtual = $row["aulavirtual"];
			mysqli_data_seek($rs,0);
		}
	else
		{
			$nombresupervisor='';
			$aulavirtual='';
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
	$titulo = $nombreproceso . '<br>RELACION DE POSTULANTES AULA '.substr($ambiente,3);
	require ('cabecera_admision.php')
?>
<br>
<table width="700">
	<tr>
    	<td width="10%">
        	<strong>
            Supervisor:
            </strong>
        </td>
        <td>
        	<?php echo $nombresupervisor?>
        </td>
    </tr>
    <tr>
    	<td width="10%">
        	<strong>
            Aula virtual:
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
    	<td width="5%" align="center"><strong>Orden</strong></td>
    	<td width="10%" align="center"><strong>C&oacute;digo</strong></td>	
    	<td width="12%" align="center"><strong>Ap. Paterno</strong></td>
        <td width="12%" align="center"><strong>Ap. Materno</strong></td>
    	<td width="16%" align="center"><strong>Nombres</strong></td>
    	<td align="center"><strong>Carrera Profesional</strong></td>
	</tr>
	<?php
	$contador = 0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		echo '<tr height="25">';
			echo '<td align="center">';
				echo $contador;
			echo '</td>';
			echo '<td align="center">';
				echo $rsjk[6];
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
				echo '<br>';
				echo '<strong>';
				echo '<span style="font-size:9px; color:#900;">';
				echo ' (';
				echo $rsjk[5];
				echo ')';
				echo '</span>';
				echo '</strong>';
			echo '</td>';
		echo '</tr>';			
  	}
	?>  
</table>
</body>
</html>