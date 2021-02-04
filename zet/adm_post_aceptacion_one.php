<?php
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
	require ('cabecera_admision2.php')
?>
<table width="750">
	<tr>
    	<td align="center">
        	<span class="zet16"><u>ANEXO 1</u></span>
            <br>
            <br>
            <br>
        </td>
    </tr>
	<tr>
    	<td align="center">
        	<span class="zet16">DECLARACI&Oacute;N JURADA DE ACEPTACI&Oacute;N</span>
        </td>
    </tr>
</table>
<br>
<table width="750">
    <tr>
    	<td width="10%">&nbsp;
        </td>
    	<td align="justify" style="line-height:20pt;">
				Yo, <strong><?php echo $nombreadmision ?></strong>, de nacionalidad peruana, identificado con documento de identidad N° <strong><?php echo $dni?></strong>, con domicilio en <strong><?php echo $direccion?></strong>; postulante a la carrera profesional de  <strong><?php echo $nombreescuela?></strong> en la modalidad <strong><?php echo $nombremodalidad ?></strong> en el Proceso de Admisi&oacute;n Virtual 2020-I de la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas Daniel Hern&aacute;ndez Morillo; en pleno uso de mis facultades f&iacute;sico mentales DECLARO BAJO JURAMENTO que conozco y acepto el contenido del Reglamento General de Admisi&oacute;n, Prospecto de Admisi&oacute;n 2020-I y los "Criterios para el desarrollo del Proceso de Admisi&oacute;n Virtual 2020-I, en el marco de emergencia sanitaria y medidas de prevenci&oacute;n de contagio y propagaci&oacute;n del COVID–19", as&iacute; como las faltas, sanciones, riesgos y requisitos m&iacute;nimos para participar en el Examen de Admisi&oacute;n Virtual 2020-I.
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
   <tr>
    	<td width="10%">&nbsp;        	
        </td>
    	<td align="justify" style="line-height:20pt;">
        	As&iacute; mismo, durante el desarrollo del Examen de Admisi&oacute;n Virtual 2020-I, me comprometo a obedecer las instrucciones del fiscalizador. 
            <br>
            <br>
        </td>
        <td width="10%">&nbsp;
        	
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
        <strong>Nota:</strong> Cualquier uso indebido del presente, ser&aacute; sancionado según las normas legales vigentes. 
        </td>
    </tr>	
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="750">
	<tr>
		<td align="center">
        	<img src="../imageneszet/logopie.jpg" />
        </td>
    </tr>
</table>