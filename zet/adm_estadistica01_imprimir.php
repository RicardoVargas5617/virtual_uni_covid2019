<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	$proceso = $_GET['codigo'];
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '05')";
	#echo $vsql;
	$rs = mysqli_query($cn, $vsql);
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
	$titulo = $nombreproceso . ' - ESTADISTICAS';
	require ('cabecera_admision.php')
?>
<table width="750" border="1">
	<tr>
    	<td width="5%" align="center"><strong>Nro.</strong></td>
     	<td align="center"><strong>Carrera</strong></td>
    	<td width="10%" align="center"><strong>Postulantes</strong></td>
    	<td width="10%" align="center"><strong>Asistentes</strong></td>
    	<td width="10%" align="center"><strong>Ausentes</strong></td>
        <td width="10%" align="center"><strong>Ingresantes</strong></td>
	</tr>
	<?php
	$contador = 0;
	$a=0;
	$b=0;
	$c=0;
	$d=0;
	while ($rsjk= mysqli_fetch_row($rs))
	{ 
		$contador = $contador + 1;
		$a=$a+$rsjk[2];
		$b=$b+$rsjk[3];
		$c=$c+$rsjk[4];
		$d=$d+$rsjk[5];
		echo '<tr>';
			echo '<td align="center">';
				echo $contador;
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
		echo '</tr>';			
  	}
	?>
    <tr>
    	<td colspan="2" align="right">
        	<strong>TOTAL</strong>
        </td>
        <td align="right">
        	<strong><?php echo $a;?></strong>
        </td>
        <td align="right">
        	<strong><?php echo $b;?></strong>
        </td>
        <td align="right">
        	<strong><?php echo $c;?></strong>
        </td>
        <td align="right">
        	<strong><?php echo $d;?></strong>
        </td>
    </tr>  
</table>
</body>
</html>