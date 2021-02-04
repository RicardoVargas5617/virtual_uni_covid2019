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
	$titulo = '';
	require ('cabecera_admision1.php')
?>
<table width="750">
	<tr>
    	<td align="center">
        	<span class="zet16">DECLARACI&Oacute;N JURADA</span>
        </td>
    </tr>
</table>
<br>
<table width="750" border="0">
    <tr>
    	<td width="5%">&nbsp;
        	
        </td>
    	<td align="center" style="line-height:20pt;">
        	<strong>DE NO POSEER ANTECEDENTES PENALES POR LA COMISI&Oacute;N DE LOS DELITOS DE TERRORISMO O APOLOG&Iacute;A AL TERRORISMO, DE VIOLACI&Oacute;N A LA LIBERTAD SEXUAL O DE TR&Aacute;FICO IL&Iacute;CITO DE DROGAS</strong>
        </td>
        <td width="5%">&nbsp;
        	
        </td>
    </tr>
</table>
<br>
<table width="750">
	<tr>
    	<td width="10%">&nbsp;
        	
        </td>
    	<td align="justify">
        	<strong>
        	Señor:<br>
			Presidente de la Comisi&oacute;n Organizadora de la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas
            </strong>
        </td>
    </tr>
</table>
<br>
<table width="750">
    <tr>
    	<td width="10%">&nbsp;
        	<!--Proceso de Admisi&oacute;n UNJ -->
        </td>
    	<td align="justify" style="line-height:20pt;">
        	Yo, <strong><?php echo $nombreadmision ?></strong>, identificado(a) con Documento Nacional de Identidad (DNI) N° <strong><?php echo $dni?></strong>, con direcci&oacute;n actual en <strong><?php echo $direccion?></strong>, Celular/Fijo <strong><?php echo $telefono?></strong>, correo electr&oacute;nico <strong><?php echo $email?></strong>, estando postulando al <strong><?php echo $macro?></strong> a la Carrera Profesional de <strong><?php echo $nombreescuela?></strong>, seg&uacute;n modalidad <strong><?php echo $nombremodalidad ?></strong>.
            <br><br>
        </td>
        <td width="10%">&nbsp;
        	
        </td>
    </tr>
   <tr>
    	<td width="10%">&nbsp;        	
        </td>
    	<td align="justify" style="line-height:20pt;">
        	<strong>DECLARO BAJO JURAMENTO</strong>, no haber sido condenado por el delito de terrorismo o apolog&iacute;a al terrorismo en cualquiera de sus modalidades, que impida mi postulaci&oacute;n a la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas, seg&uacute;n el Art. 98&deg; de la Ley Universitaria N&deg; 30220, ni tampoco por los delitos de  violaci&oacute;n a la libertad sexual o de tr&aacute;fico il&iacute;cito de drogas, seg&uacute;n Ley N&deg; 29988.
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
        	Doy fe que esta declaraci&oacute;n corresponde a la verdad, por lo que me someto a las responsabilidades a que hubiere lugar en caso de consignar informaci&oacute;n falsa.
            <br>
        </td>
        <td width="10%">&nbsp;        	
        </td>
    </tr>
</table>
<br>
<table width="750">
	<tr>
    	<td width="20%">&nbsp;
        	
        </td>
        <td>
        	Atentamente,
        </td>
    </tr>	
</table>
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
<table width="750" border="0">
	<tr>
    	<td width="10%">&nbsp;
        	
        </td>
        <td width="15%" valign="bottom">
        	_____________________________________
        </td>
        <td width="5%">&nbsp;
        	
        </td>
        <td width="15%">
        	<table width="100%" border="1" style="border-style:solid">
            	<tr>
                	<td height="120">&nbsp;
                    	
                    </td>
                </tr>
            </table>
        </td>
        <td>&nbsp;
        	
        </td>
    </tr>
    <tr>
    	<td>&nbsp;
       		
        </td>
        <td align="center">
       		<strong>Firma</strong>
        </td>
        <td>&nbsp;
       		
        </td>
        <td align="center">
       		<strong>Huella</strong>
        </td>
    </tr>
</table>
<br>
<table width="750">
	<tr>
   		<td width="10%">
        	&nbsp
        </td>
    	<td class="zet9real" align="justify">
        	Art. 32&deg- Ley 27444. En caso de comprobarse fraude, falsedad en la declaraci&oacute;n o informaci&oacute;n presentada por el administrado, la entidad considerar&aacute; no satisfecha la exigencia para todos sus efectos procediendo a comunicar el hecho para que se declare la nulidad del acto administrativo, imponga a quien haya empleado dicha declaraci&oacute;n jurada una multa, y de ser el caso comunicar el hecho al Ministerio P&uacute;blico para la denuncia correspondiente.
        </td>
        <td width="10%">
        	&nbsp
        </td>
    </tr>
</table>