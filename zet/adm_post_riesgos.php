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
	$postulante = substr($codigo,4,7);	
	$reporte = '';
	
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
.zet9real {
	font-size: 10px;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
}
.zet16 {
	font-size: 16px;
	font-weight:bold;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<?php 
	require ('cabecera_admision2.php')
?>
<br>
<br>
<table width="750">
	<tr>
    	<td align="center">
        	<span class="zet16"><u>ANEXO 2</u></span>
            <br>
            <br>
            <br>
        </td>
    </tr>
	<tr>
    	<td align="center">
        	<span class="zet16">RIESGOS EN EL EXAMEN DE ADMISI&Oacute;N VIRTUAL</span>
        </td>
    </tr>
</table>
<br>
<table width="750">
    <tr>
    	<td width="10%">&nbsp;
        </td>
    	<td align="justify" style="line-height:20pt;">
				Yo, <strong><?php echo $nombreadmision ?></strong>, de nacionalidad peruana, identificado con documento de identidad N° <strong><?php echo $dni?></strong>, con domicilio en <strong><?php echo $direccion?></strong>; postulante a la carrera profesional de  <strong><?php echo $nombreescuela?></strong> en la modalidad <strong><?php echo $nombremodalidad ?></strong> en el Proceso de Admisi&oacute;n Virtual 2020-I de la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas Daniel Hern&aacute;ndez Morillo; DECLARO BAJO JURAMENTO conocer los riesgos de un examen no presencial on-line, los cuales me comprometo a prevenir y reducir BAJO MI RESPONSABILIDAD: 
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
   <tr>
    	<td width="10%">&nbsp;        	
        </td>
    	<td align="justify" style="line-height:20pt;">
        	<ol>
            <li>
        	Limitado o nulo acceso al servicio de internet por tiempo de dos (02) horas como m&iacute;nimo con la fluidez de datos y sin interferencia.
            </li>
            <li>
			Ausencia de energ&iacute;a el&eacute;ctrica para la computadora port&aacute;til (laptop).
			</li>
			<li>
			Baja o limitada carga de bater&iacute;a del celular.
            </li>
			<li>
			Ambiente no apropiado para rendir el examen virtual, que tenga interrupci&oacute;n por ruidos, terceras personas o interrupci&oacute;n por necesidades biol&oacute;gicas.
            </li>
            <li>
			Interrupci&oacute;n de la conectividad de internet, audio o video, por tener encendido alg&uacute;n aparato electr&oacute;nico adicional a la laptop y celular con el que rendir&aacute; el examen.
            </li>
            <li> 
			Interrupci&oacute;n, fraude, robo de informaci&oacute;n o acceso no autorizado en el examen de admisi&oacute;n virtual, por hacking, phishing u otros aplicativos maliciosos; cuando ejecute una p&aacute;gina web, aplicativos on-line, conexi&oacute;n remota u otro software que no est&eacute; autorizado; con excepci&oacute;n del sistema SISACAD-MODULO DE ADMISI&oacute;N y el aplicativo de verificaci&oacute;n y monitoreo proporcionado por la Direcci&oacute;n de Admisi&oacute;n.
            </li>
			<br>
		</ol>
        </td>
        <td width="10%">&nbsp;
        	
        </td>
   </tr>
</table>
<br>
<table width="750">
    <tr>
    	<td align="center" style="line-height:20pt;">
        	_________________________________________________
        </td>
    </tr>
   <tr>
    	<td align="center">
        	Nombres, Apellidos, DNI y firma del postulante
            <br>
        </td>
</table>
<br>
<br>
<br>
<table width="750">
	<tr>
    	<td align="center" width="10%">&nbsp;
        	
        </td>
    	<td>
        <strong>Nota:</strong> Cualquier uso indebido del presente, ser&aacute; sancionado seg&uacute;n las normas legales vigentes. 
        </td>
    </tr>	
</table>
<br>
<table width="750">
	<tr>
		<td align="center">
        	<img src="../imageneszet/logopie.jpg" />
        </td>
    </tr>
</table>
</body>
</html>