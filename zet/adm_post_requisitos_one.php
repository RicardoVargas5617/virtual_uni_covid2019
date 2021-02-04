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
        	<span class="zet16"><u>ANEXO 3</u></span>
            <br>
            <br>
            <br>
        </td>
    </tr>
	<tr>
    	<td align="center">
        	<span class="zet16">REQUISITOS M&Iacute;NIMOS</span>
        </td>
    </tr>
</table>
<br>
<table width="750">
    <tr>
    	<td width="10%">&nbsp;
        </td>
    	<td align="justify" style="line-height:20pt;">
				Yo, <strong><?php echo $nombreadmision ?></strong>, de nacionalidad peruana, identificado con documento de identidad N° <strong><?php echo $dni?></strong>, con domicilio en <strong><?php echo $direccion?></strong>; postulante a la carrera profesional de  <strong><?php echo $nombreescuela?></strong> en la modalidad <strong><?php echo $nombremodalidad ?></strong> en el Proceso de Admisi&oacute;n Virtual 2020-I de la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas Daniel Hern&aacute;ndez Morillo; para poder rendir el examen de admisi&oacute;n no presencial on-line, DECLARO BAJO JURAMENTO disponer como m&iacute;nimo: 
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
        	Un (01) ambiente privado, sin interrupci&oacute;n de equipos electr&oacute;nicos encendidos (radio, televisor, celulares, computadoras u otros), acondicionado con una (01) silla y una (01) mesa, escritorio u otro de 1 metro por 60 cm. Aproximadamente.
            </li>
            <li>
			Una (01) computadora o laptop con:
            	<ul>
                	<li>C&aacute;mara web operativo.</li>
                    <li>Conexi&oacute;n a internet por wifi o cableado.</li>
                    <li>Capacidad de memoria de 4GB de RAM (recomendado).</li>
                    <li>Procesador Intel Celeron o superior.</li>
                    <li>Navegador web Google o Mozilla.</li>
                    <li>Conectada a energ&iacute;a el&eacute;ctrica o con bater&iacute;a cargada al 100% que garantice una duraci&oacute;n por m&aacute;s de dos (02) horas.</li>
                </ul>
			</li>
			<li>
			Un (01) celular smartphone con:
                <ul>
                        <li>C&aacute;mara</li>
                        <li>Conexi&oacute;n a internet.</li>
                        <li>Sistema Android compatible con Google Meet.</li>
                        <li>Conectada a energ&iacute;a el&eacute;ctrica o con bater&iacute;a cargada al 100% que garantice una duraci&oacute;n por m&aacute;s de dos (02) horas.</li>
                    </ul>
            </li>            	
			<li>
			Servicio de internet por un periodo aproximado de dos (02) horas.
            </li>
            <li>
			Correo electr&oacute;nico en Gmail.
            </li>
		</ol>
        </td>
        <td width="10%">&nbsp;
        	
        </td>
   </tr>
</table>
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
<br>
<table width="750">
	<tr>
		<td align="center">
        	<img src="../imageneszet/logopie.jpg" />
        </td>
    </tr>
</table>