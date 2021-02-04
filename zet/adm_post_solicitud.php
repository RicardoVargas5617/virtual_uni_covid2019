<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	include('../funciones/admi_fun_admision.php');

	$cn = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);	
	$reporte='';
	
	$nombreproceso = nombreproceso($proceso);
	$macro = nombremacro($proceso);
	$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','',0,0,'','','','','','','',0,0,0,0,0,'00','00','00','','',0,0,'','1','2','3','4','5','6','7','D')";	
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			$nombremodalidad = $row["nombremodalidadadmision"];
			$nombreescuela = $row["nombreescuela"];
			$nombreadmision = $row["nombreadmision"];
			$dni = $row["numerodocumento"];
			$numerodocumento = $row["numerodocumento"];
			$direccion = $row["direccion"];
			$email = trim($row["email"]);
			$telefono = $row["telefono"];	
			$fecharegistro =  $row["fecharegistro"];
			mysqli_data_seek($rs,0);
		}
	
	if ($email=='')
		{
			$email='(x)';	
		}
	$dia = substr($fecharegistro,0,2);
	$mes = substr($fecharegistro,3,2);
	$anio = substr($fecharegistro,6,4);
	
	$nombremes = nombremes($mes);
	$fecha = 'Pampas, '.$dia.' de '.$nombremes.' del '.$anio;
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
.zet16 {
	font-size: 16px;
	font-weight:bold;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 
	require ('cabecera_admision1.php')
?>
<br>
<br>
<table width="750">
	<tr>
    	<td align="center">
        	<span class="zet16">SOLICITUD DEL POSTULANTE</span>
        </td>
    </tr>
</table>
<br>
<br>
<table width="750">
	<tr>
    	<td width="10%">&nbsp;
        	
        </td>
    	<td align="justify">
        	SE&Ntilde;OR PRESIDENTE DE LA COMISI&Oacute;N ORGANIZADORA DE LA Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas;
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
        	Yo, <strong><?php echo $nombreadmision ?></strong>, identificado(a) con Documento Nacional de Identidad (DNI) N° <strong><?php echo $dni?></strong>, con direcci&oacute;n actual en <strong><?php echo $direccion?></strong>, Celular/Fijo <strong><?php echo $telefono?></strong>, correo electr&oacute;nico <strong><?php echo $email?></strong>, solicito a usted se me inscriba como postulante del <strong><?php echo $macro?></strong> a la Carrera Profesional de <strong><?php echo $nombreescuela?></strong>, seg&uacute;n modalidad <strong><?php echo $nombremodalidad ?></strong>, para tal efecto cumplo con los requisitos exigidos por el Reglamento General del Proceso de Admisi&oacute;n de la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas y el Prospecto de Admisi&oacute;n o Gu&iacute;a del Postulante correspondiente, actualmente regulados y autorizados por la Superintendencia Nacional de Educaci&oacute;n Superior Universitaria (SUNEDU), cuyas disposiciones declaro conocer y a las cuales me someto.
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
        	<?php echo $fecha?>
        </td>
        <td width="10%">
        	&nbsp
        </td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="750">
	<tr>
    	<td align="center" width="40%" class="zet9">
        	___________________________________
        </td>
        <td width="20%">&nbsp;
        	
        </td>
        <td align="center" width="40%" class="zet9">
        	___________________________________
        </td>        
    </tr>
    <tr>
    	<td align="center" class="zet9">
        	Firma del Postulante
        </td>
        <td>&nbsp;
        	
        </td>
        <td align="center" class="zet9">
        	Responsable de la Inscripci&oacute;n
        </td>        
    </tr>
    <tr>
    	<td align="center">&nbsp;
        	
        </td>
        <td>&nbsp;
        	
        </td>
        <td align="left" class="zet9">
        	Nombres
        </td>        
    </tr>
</table>
</body>
</html>