<?php	
   ########################
	#######################
	$titulo7 = 'CONSTANCIA DE INSCRIPCIÓN';		
	$vd70 = '	
		<br>
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
					$titulo7.
					'</span>
				</td>
			</tr>
		</table>';		
	//datos primera sección
	$vd71 = '
		<div style="text-align: left; font-size:9px;">
		<table width="750">
			<tr height="40">
			    <td align="left" width="35%">
        			<strong>NOMBRE POSTULANTE:</strong>
        		</td>
        		<td style="text-transform: uppercase;">'.
        			$nombrealumno.
        		'</td>
			</tr>
			<tr height="40">
			    <td align="left" width="35%">
        			<strong>DNI:</strong>
        		</td>
        		<td style="text-transform: uppercase;">'.
        			$numerodocumento.
        		'</td>
			</tr>
			<tr height="40">
			    <td align="left" width="35%">
        			<strong>CARRERA PROFESIONAL</strong>
        		</td>
        		<td style="text-transform: uppercase;">'.
        			$nombreescuela.
        		'</td>
			</tr>
			<tr height="40">
				<td align="left">
					<strong>MODALIDAD:</sstrong>
				</td>
				<td style="text-transform: uppercase;">'.
				$nombremodalidad.
				'</td>
			</tr>
			<tr height="40">
				<td align="left">
					<strong>CÓDIGO:</sstrong>
				</td>
				<td style="text-transform: uppercase;">'.
				generar_codigo_u($_SESSION["persona"])
				.
				'</td>
			</tr>
		</table>
		';


		/*
		$ERROR = '<tr>
				<td width="3%">
				</td>
				<td align="justify">

					Yo, <strong>'.
					$nombrealumno.
					'</strong>, de nacionalidad peruana, identificado con documento de identidad Nro. <strong>'.
					$dni.
					'</strong>, con domicilio en  <strong>'.
					$domicilio.
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
					<strong>DECLARO BAJO JURAMENTOOSE</strong>, no haber sido condenado por el delito de terrorismo o apolog&iacute;a al terrorismo en cualquiera de sus modalidades, que impida mi postulaci&oacute;n a la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas, seg&uacute;n el Art. 98° de la Ley Universitaria N° 30220, ni tampoco por los delitos de violaci&oacute;n a la libertad sexual o de tr&aacute;fico il&iacute;cito de drogas, seg&uacute;n Ley N° 29988.
                	<br>
                    Doy fe que esta declaraci&oacute;n corresponde a la verdad, por lo que me someto a las responsabilidades a que hubiere lugar en caso de consignar informaci&oacute;n falsa.
				</td>
			</tr>';
			*/

?>