<?php	
    ########################
	#######################
	$titulo = 'FICHA DE INSCRIPCION DEL POSTULANTE';
$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','',0,0,'','','','','','','',0,0,0,0,0,'00','00','00','','',0,0,'','1','2','3','4','5','6','7','G')";	
	#echo $vsql;
	$rs = mysqli_query($cnzet,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			$nombremodalidad = $row["nombremodalidadadmision"];
			$nombreescuela = $row["nombreescuela"];
			$apellidopaterno = $row["apellidopaterno"];
			$apellidomaterno = $row["apellidomaterno"];
			$nombre = $row["nombre"];
			$fechanacimiento = $row["fechanacimiento"];
			$nombreadmision = $row["nombreadmision"];
			$numerodocumento = $row["numerodocumento"];
			$dni = $row["numerodocumento"];
			$sexo = $row["sexo"];
			$direccion = $row["direccion"];
			$domicilio = $row["direccion"];
			$celular = $row["telefono"];
			$email = trim($row["email"]);
			$telefono = $row["telefono"];
			$recibopago = $row["recibopago"];
			$tipocolegio = $row["tipocolegio"];
			$certificado = $row["certificado"];	
			$fecharegistro =  $row["fecharegistro"];
			$anioegreso =  $row["anioegreso"];
			$colegio =  $row["colegio"];
			$nombredepartamento =  $row["nombredepartamento"];
			$nombreprovincia =  $row["nombreprovincia"];
			$nombredistrito =  $row["nombredistrito"];
			$descripcionmoda =  $row["descripcionmoda"];			
			mysqli_data_seek($rs,0);
		}
		
	if ($email=='')
		{
			$email='(x)';	
		}	
	$altura = 40;	
	$dia = substr($fecharegistro,0,2);
	$mes = substr($fecharegistro,3,2);
	$anio = substr($fecharegistro,6,4);
	$fotex = mostrarfoto_postulante_pfd($numerodocumento);
	
	$nombremes = nombremes($mes);
	$fecha = 'Pampas, '.$dia.' de '.$nombremes.' del '.$anio;
		
	$vc = '	
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
					$titulo.
					'</span>
				</td>
			</tr>
		</table>';		

	$v2 = '
		<table width="750" border="0" cellpadding="3" cellspacing="3">
			<tr height="'.$altura.'">
			    <td align="left" width="35%">
        			<strong>CARRERA PROFESIONAL A LA QUE POSTULA:</strong>
        		</td>
        		<td>'.
        			$nombreescuela.
        		'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>MODALIDAD:</sstrong>
				</td>
				<td>'.
					$nombremodalidad.		
				'</td>
    		</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>APELLIDO PATERNO:</strong>
				</td>
				<td>'.
        			$apellidopaterno.
        		'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>APELLIDO MATERNO:</strong>
				</td>
				<td>'.
					$apellidomaterno.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>NOMBRE:</strong>
				</td>
				<td>'.
					$nombre.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>FECHA NACIMIENTO:</strong>
				</td>
				<td>'.
					$fechanacimiento.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>NRO. DNI:</strong>
				</td>
				<td>'.
					$dni.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>SEXO:</strong>
				</td>
				<td>'.
					$sexo.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>DOMICILIO:</strong>
				</td>
				<td>'.
					$domicilio.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>REGION:</strong>
				</td>
				<td>'.
					$nombredepartamento.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>PROVINCIA:</strong>
				</td>
				<td>'.
					$nombreprovincia.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>DISTRITO:</strong>
				</td>
				<td>'.
					$nombredistrito.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>CELULAR:</strong>
				</td>
				<td>'.
					$celular.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>EMAIL:</strong>
				</td>
				<td>'.
					$email.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>TIPO COLEGIO:</strong>
				</td>
				<td>'.
					$tipocolegio.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>COLEGIO:</strong>
				</td>
				<td>'.
					$colegio.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>A&Ntilde;O DE EGRESO:</strong>
				</td>
				<td>'.
					$anioegreso.
				'</td>
			</tr>
			<tr height="'.$altura.'">
				<td align="left">
					<strong>PROMEDIO PONDERADO:</strong>
				</td>
				<td>'.
					$certificado.
				'</td>
			</tr>
		</table>';
		
	$v3 = '
		<br>
		<table width="750">
			<tr>
				<td align="right">'.
					$fecha.
				'</td>
			</tr>	
		</table>
		<br>
		<table width="750" border="0">
			<tr>
				<td width="10%">
					
				</td>
				<td width="35%" valign="bottom">
					_____________________________________
				</td>
				<td width="10%">
					
				</td>
				<td width="15%">
					<table width="100%" border="1" style="border-style:solid">
						<tr>
							<td height="120">
								
							</td>
						</tr>
					</table>
				</td>
				<td width="30%">		
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td align="center">
					<strong>Firma del postulante</strong>
				</td>
				<td>
					
				</td>
				<td align="center">
					<strong>Indice derecho</strong>
				</td>
			</tr>
		</table>
	';	
	######################
	#######################
?>