<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	#echo '1';
	#exit;
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	include_once "../config.php";	
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	require_once GL_DIR_FS_APP.'vendor/autoload.php';	
	$cn_zet = conectar();
	#echo '1';
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	$proceso = $_GET['codigo'];
	$nombreproceso = nombreproceso($proceso);
	$contador = 0;
	
	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','', 'C')";
	$rs_zet = mysqli_query($cn_zet, $vsql);

	#####################################							
    while ($rsjk_zet=mysqli_fetch_row($rs_zet))
        {
            #ImprimirConstanciaIngreso($rsjk[0],$rsjk[1],$rsjk[2]);
			#echo '<span style="page-break-before:always;"></span>';
		$contador = $contador+1;
		$cn_zoz = conectar();	
		$vsql = "call zyz_CAConstancia ('". $rsjk_zet[0] . "', '". $rsjk_zet[1]. "','". $rsjk_zet[2]. "','I')";	
		#echo $vsql;
		$rs = mysqli_query($cn_zoz, $vsql);			
		$numeroregistros = mysqli_num_rows($rs); 
	
		if ($numeroregistros > 0)
			{
				$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
				$numerodocumento = $row["numerodocumento"];
				$apellidos = $row["apellidos"];
				$nombres = $row["nombres"];
				$escuela = $row["escuela"];
				$modalidad = $row["modalidad"];
				$puntaje = $row["puntaje"];
				$res = $row["res"];
				$resoluciongeneral = $row["resoluciongeneral"];
				$fechita = $row["fechita"];
				$responsable = $row["responsable"];
				$descripcion = $row["descripcion"];
				#$descripcion = $row["observacion"];
				$moda = $row["moda"];
				mysqli_data_seek($rs,0);
			}	
		######	

			if($proceso<>'0014')
					{
						$punt = '
							<tr height="60">
								<td align="center">
									<span style="font-size:16px; font-weight:bold">
									PUNTAJE
									</span>
								</td>
								<td>
								<span style="font-size:16px;">'.
									$puntaje.
								'</span>
								</td>
							</tr>';			
					}		
			else
				{
					$punt = '';	
				}
		
		
		#######
		$cabecera = '
		<table width="750" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="20%" align="center">
					<img src="../imageneszet/unat.png" width="120" />
				</td>
				<td align="center">
					<span style="font-size:26px; font-weight:bold">Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas
					<br>
					"Daniel Hern&aacute;ndez Morillo"
					</span>
					<br>
					<span style="font-size:18px;">
					LEY DE CREACI&Oacute;N Nro. 29716
				  	</span>
					<br>
					<span style="font-size:9px;">
					RESOLUCI&Oacute;N DEL CONSEJO DIRECTIVO Nro. 016-2019-SUNEDU/CD (RESOLUCI&Oacute;N DE LICENCIA INSTITUCIONAL)
					<br>
					RESOLUCI&Oacute;N DE COMISI&Oacute;N ORGANIZADORA Nro. 046-CO-UNAT (APROBACI&Oacute;N DEL REGLAMENTO GENERAL DE ADMISI&Oacute;N-2019-1)
					<br>
					RESOLUCIÓN DE COMISI&Oacute;N ORGANIZADORA Nro.'.
					$resoluciongeneral.'
					(APROBACI&Oacute;N DEL MODELO DE CONSTANCIA DE INGRESO)
					</span>
				</td>
			</tr>
		</table>
		<br>
		<br>';


		$v = '
			<table width="750" border="0">
				<tr height="60">
					<td align="center" width="20%">
						<span style="font-size:16px; font-weight:bold">
						C&Oacute;DIGO DE POSTULANTE (DNI)
						</span>
					</td>
					<td>
						<span style="font-size:16px;">'.
						$numerodocumento.
						'</span>
					</td>
					<td width="20%" rowspan="3"  align="center">
						<table width="80%" style="border:dotted">
							<tr height="130">
								<td width="100%">&nbsp;									
								</td>
							</tr>
						</table>
						FOTO
					</td>
				</tr>
				<tr height="60">
					<td align="center">
						<span style="font-size:16px; font-weight:bold">
						NOMBRES
						</span>
					</td>
					<td>
						<span style="font-size:16px;">'.
						$nombres.
						'</span>
					</td>
				</tr>
				<tr height="60">
					<td align="center">
						<span style="font-size:16px; font-weight:bold">
						APELLIDOS
						</span>
					</td>
					<td>
						<span style="font-size:16px;">'.
						$apellidos.
						'</span>
					</td>
				</tr>
				<tr height="60">
					<td align="center">
						<span style="font-size:16px; font-weight:bold">
						CARRERA PROFESIONAL
						</span>
					</td>
					<td>
						<span style="font-size:16px;">'.
						$escuela.
						'</span>
					</td>
					<td rowspan="3"  align="center">
						<table width="80%" style="border:dotted">
							<tr height="130">
								<td width="100%">&nbsp;
									
								</td>
							</tr>
						</table>
						HUELLA DIGITAL
					</td>
				</tr>
				<tr height="60">
					<td align="center">
						<span style="font-size:16px; font-weight:bold">
						MODALIDAD
						</span>
					</td>
					<td>
						<span style="font-size:16px;">'.
						$modalidad.
						'</span>
					</td>
				</tr>'.
					$punt.
				'<tr height="60">
					<td align="center">
						<span style="font-size:16px; font-weight:bold">
						RESOLUCI&Oacute;N Nro.
						</span>
					</td>
					<td>
						<span style="font-size:16px;">'.
							$res.			
						'</span>
					</td>
					<td  align="center">        
					</td>
				</tr>
			</table>
			<br>
			<br>
			<table width="750">
				<tr>
					<td align="right">
						<span style="font-size:16px;">
						Pampas,'.
						$fechita.
						'</span>
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
					<td width="25%">
						&nbsp;;
					</td>
					<td align="center" style="border-top-style:dotted; border-top-width:medium">
						<span style="font-size:16px;">'.
						$responsable.
						'</span>
					</td>
					<td width="25%">;						
					</td>
				</tr>
				<tr>
					<td>				
					</td>
					<td align="center">
						<span style="font-size:14px; font-weight:bold">
						DIRECTOR DE ADMISI&Oacute;N
						</span>
					</td>
					<td>&nbsp;
						
					</td>
				</tr>
			</table>';
			#$v = $contador;
			echo $cabecera;
			echo '';
			echo $v;
		}
	
?>
