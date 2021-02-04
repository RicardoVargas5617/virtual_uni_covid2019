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
	$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','',0,0,'','','','','','','',0,0,0,0,0,'00','00','00','','','1','2','3','4','5','6','7','F')";	
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			$nombrecompleto = $row["nombrecompleto"];
			$observacionproceso = $row["observacionproceso"];
			$nombreescuela = $row["nombreescuela"];	
			$puestonombre = $row["nombrepuesto"];
			$puntaje = $row["puntaje"];
			$fechaproceso =  $row["fechaproceso"];
			$fechaactual =  $row["fechaactual"];
			$macro =  $row["macro"];
			$descripcionmodalidad =  $row["descripcionmodalidad"];
			$numerodocumento =  $row["numerodocumento"];
			mysqli_data_seek($rs,0);
		}
	
	####################################
	$dia = substr($fechaproceso,0,2);
	$mes = substr($fechaproceso,3,2);
	$anio = substr($fechaproceso,6,4);
	
	$nombremes = nombremes($mes);
	$fecha = $dia.' de '.$nombremes.' del '.$anio;
	####################################
	$diaactual = substr($fechaactual,0,2);
	$mesactual = substr($fechaactual,3,2);
	$anioactual = substr($fechaactual,6,4);
	
	$nombremesactual = nombremes($mesactual);
	$fechita = 'Pampas, '. $diaactual.' de '.$nombremesactual.' del '.$anioactual;
	####################################
	
	$nombreproceso = nombreproceso($proceso);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>POSTULANTES</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 12px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
.zet9 {
	font-size: 11px;
}
.zet14 {
	font-size: 14px;
	font-weight:bold;
}
.zet22 {
	font-size: 22px;
	font-weight:bold;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 
	$reporte='';
	require ('cabecera_admision1.php')
?>
<br>
<br>
<table width="750">
	<tr>
   		<td width="10%">&nbsp;
        	
        </td>
    	<td align="center">
        	<span class="zet14">EL QUE SUSCRIBE, PRESIDENTE DE LA COMISI&Oacute;N PERMANENTE DE ADMISI&Oacute;N DE LA Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas, DEJA:</span>
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<table width="750">
	<tr>
    	<td align="center">
        	<span class="zet22"><u>CONSTANCIA</u></span>
        </td>
    </tr>
</table>
<br>
<br>
<br>
<table width="750">
    <tr>
    	<td width="10%">&nbsp;
        	
        </td>
    	<td align="justify" style="line-height:20pt;">
        	Que, <strong><?php echo $nombrecompleto ?></strong>, identificado(a) con Documento Nacional de Identidad &numero; <strong><?php echo $numerodocumento?></strong>, ha ingresado a la Carrera Profesional de <strong><?php echo $nombreescuela?></strong>, en la <strong>Sede CENTRAL</strong>, ocupando el <strong><?php echo $puestonombre ?> PUESTO</strong>, en la modalidad <strong><?php echo $descripcionmodalidad?></strong>, obteniendo un total de <strong><?php echo $puntaje ?> puntos</strong> en el <strong><?php echo $observacionproceso ?></strong> del d&iacute;a <?php echo $fecha ?>, correspondiente al <strong><?php echo $macro?></strong>.
            <br>
            <br>
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
    <tr>
    	<td width="10%">&nbsp;
        	
        </td>
    	<td align="justify" style="line-height:20pt;">
        	Se expide la presente, a petici&oacute;n de la parte interesada para los fines que estime conveniente.
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
</table>
<br>
<br>
<table width="750">
	<tr>
    	<td align="right">
        	<?php echo $fechita?>
        </td>
        <td width="10%">
        	&nbsp
        </td>
    </tr>
</table>

</body>
</html>