<?php	
   ########################
	#######################
	#echo 'hola';
	$direccion = '';
	$titulo2 = 'DECLARACI&Oacute;N JURADA';		
	$vd20 = '	
		<table width="750">
			<tr>
				<td width="85%" align="right">
					<span style="font-size:12px;">C&Oacute;DIGO DEL POSTULANTE: &nbsp;&nbsp;</span>
				</td>
				<td>
					<table border="1" width="100%">
						<tr>
							<td align="center" style="border-left:thin; border-right:thin; border-top:thin; border-bottom:thin;">'.                    
								$numerodocumento.
							'</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table width="750">
			<tr>
				<td align="center">
					<span style="font-size:17px; font-weight:bold">'.
					$nombreproceso.
					'</span>
				</td>
			</tr>
			<tr>
				<td align="center">
					<span style="font-size:17px; font-weight:bold">'.
					$titulo2.
					'</span>
				</td>
			</tr>
		</table>';		

	$vd21 = '
		<div style="text-align: left; font-size:9px;">
		<table width="750" border="0">
			<tr>
				<td width="2%">&nbsp;
					
				</td>
				<td align="center" style="line-height:20pt;">
					<strong>DE ACEPTACI&Oacute;N DE CONDICIONES EXAMEN ADMISION VIRTUAL</strong>
				</td>
				<td width="2%">&nbsp;
					
				</td>
			</tr>
		</table>
		<table width="750">
			<tr>
				<td width="3%">
				</td>
				<td align="justify">
					Yo, <strong>'.
					$nombrealumno.
					'</strong>, de nacionalidad peruana, identificado con documento de identidad Nro. <strong>'.
					$dni.
					'</strong>, con domicilio en  <strong>'.
					$direccion.
					'</strong>, del distrito <strong>'.
					$nombredistrito.
					'</strong>, provincia <strong>'.
					$nombreprovincia.
					'</strong>, de la regi&oacute;n <strong>'.
					$nombredepartamento.
					'</strong> postulante a la Carrera Profesional de <strong>'.
					$nombreescuela.
					'</strong>, seg&uacute;n modalidad <strong>'.
					$nombremodalidad.
					'</strong>, en el Proceso de admisi&oacute;n  <strong>'.
					$nombreproceso.
					'</strong>, de la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas de Andahuaylas; en pleno uso de mis facultades f&iacute;sico mentales.<br><br><br>
					<strong>DECLARO BAJO JURAMENTO</strong> que conozco y acepto el contenido del Reglamento del Proceso de Admisi&oacute;n Remoto 2020 - II, Prospecto de Admisi&oacute;n y los "Lineamientos para el desarrollo del proceso de admisi&oacute;n, en el marco de emergencia sanitaria y medidas de prevenci&oacute;n de contagio y propagaci&oacute;n del COVID 19", as&iacute; como las faltas, sanciones, riesgos y requisitos m&iacute;nimos para participar en el examen virtual. As&iacute; mismo, durante el desarrollo del Examen de Admisi&oacute;n Virtual, me comprometo a cumplir con las instrucciones del supervisor o fiscalizador de la sesi&oacute;n virtual.
				</td>
			</tr>
		</table>
			';
?>