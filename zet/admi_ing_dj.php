<?php 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cn_zyz = conectar();
	$cn_zoz = conectar();
	#echo $persona;
	#echo $usuario;
	mysqli_query($cn_zyz,"SET CHARACTER SET utf8");
	mysqli_query($cn_zyz,"SET NAMES utf8");	
	mysqli_query($cn_zoz,"SET CHARACTER SET utf8");
	mysqli_query($cn_zoz,"SET NAMES utf8");	
	$vsql = "call zyz_CAConstancia ('0003', '','". $persona . "', 'I','','C')";
	#echo $vsql;
	$cod = 0;
	$conforme = '';
	#echo $moodle;
	#$moodle = 0;
	$registro = 0;
	$rs_postulante = mysqli_query($cn_zyz,	$vsql);	
	$num= mysqli_num_rows($rs_postulante); 	
	$rsjk = mysqli_fetch_row($rs_postulante);	
	$dni = $rsjk[3];
	$nombrecompleto = $rsjk[4];
	$escuela = $rsjk[5];
	$modalidad = $rsjk[6];
	$dj  = $rsjk[9];
	$sub  = $rsjk[11];
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="admi_ing_dj_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<?php
	if ($dj==0)
		{
			echo '<table width="600">';					
					if ($sub == 1)
						{	
							echo '<tr>';
								echo '<td width="6%">';
									echo '<input name="chkConforme" id="chkConforme" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="0">';
								echo '</td>';
								echo '<td>';
									echo 'He le&iacute;do integramente la Declaraci&oacute;n Jurada para recabar constancia de ingreso y declaro bajo juramento que acepto el integro de su contenido.';
								echo '</td>';							
							echo '</tr>';
							echo '<tr>';
								echo '<td colspan="2" align="center">';
									echo '<input name="codigo" type="hidden" value="'.$persona.'">';
									echo '<input name="cmdGrabar" type="submit" value="Aceptar" class="btn btn-primary">';
								echo '</td>';							
							echo '</tr>';
						}
					else
						{
							echo '<div class="alert alert-danger">';
							echo '<span class="semi-bold" style="font-size:16px;">Tiene que subir los documentos requeridos, antes de aceptar la declaraci&oacute;n jurada.</span>';
							echo '</div>';
						}
				echo '</table>';		
		}
	else
		{
			echo '<div class="alert alert-danger">';
			echo '<span class="semi-bold" style="font-size:16px;">Usted acept&oacute; la declaraci&oacute;n jurada.</span>';
			echo '</div>';
		}
	?>
</form>
<br>
<table width="100%">
	<tr>
    	<td align="center">
        	<span style="font-size:22px">DECLARACI&Oacute;N JURADA PARA RECABAR CONSTANCIA DE INGRESO</span>
            <br>
        </td>
    </tr>
    <tr>
    	<td style="font-size:14px;">
        <br>
Yo, <strong style="font-size:16px;"><?php echo $nombrecompleto;?></strong>, con DNI Nro. <strong style="font-size:16px;"><?php echo $dni;?></strong>, en mi condici&oacute;n de ingresante a la Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas Daniel Hern&aacute;ndez Morillo, a la carrera profesional de <strong style="font-size:16px;"><?php echo $escuela;?></strong>, en la modalidad de <strong style="font-size:16px;"><?php echo $modalidad;?></strong>; con la finalidad de recabar mi Constancia de Ingreso; con conocimiento y garantía de mi apoderado o tutor; 
		</td>
    </tr>
    <tr>
    	<td style="font-size:14px;">
        <br>
<strong style="font-size:16px;">Declaro bajo juramento</strong> que, cumplo con los requisitos exigidos en el Art. 80º del Reglamento General de Admisi&oacute;n de la UNAT, los cuales me comprometo a regularizar ante la Direcci&oacute;n de Gesti&oacute;n Acad&eacute;mica hasta el <strong style="font-size:16px;">15 de julio</strong> del presente a&ntilde;o. Compromiso que asumo por estar imposibilitado de presentar mis requisitos de ingreso en original y de forma presencial, debido la pr&oacute;rroga del estado de emergencia seg&uacute;n Decreto Supremo Nº 094-2020-PCM,   
		</td>
    </tr>
    <tr>
    	<td style="font-size:14px;">
        	<br>
			Requisitos que me comprometo a regulariza en original: <br>
			<ol>
				<li>Comprobante de pago por derecho de constancia de ingreso <strong style="font-size:16px;">(todas las modalidades)</strong> </li>
				<li>Comprobante de pago por derecho de inscripci&oacute;n, <strong style="font-size:16px;">(solo los ingresantes por CPUNAT)</strong></li>
				<li>Certificado de estudios, en original, del 1º al 5º grado de educaci&oacute;n secundaria, expedido por el director de la IE <strong style="font-size:16px;">(todas las modalidades).</strong></li>  
				<li>Copia certificada o Acta de nacimiento en original (todas las modalidades).  </li>
				<li>Otros documentos, en original, exigidos por la modalidad respectiva.</li>
			</ol>
		</td>
     </tr>
     <tr>
     	<td style="font-size:14px;">
        <br>
En el caso que falte a mi juramento, acepto perder mi vacante de ingreso conforme al Art. 82 del RGA, sin derecho a reclamo alguno y me someto a las sanciones que correspondan seg&uacute;n el Reglamento General de Admisi&oacute;n y dispositivos legales vinculados. 
		</td>
     </tr>
     <tr>
     	<td style="font-size:14px;">
        <br>
En se&ntilde;al de fe, verdad y compromiso, acepto el presente documento en toda su extensi&oacute;n.
		<br>
        <br>        
		</td>
    </tr>
    <tr>
     	<td style="font-size:14px;" align="center">
        	<table width="100%" border="0">
            	<tr>
                	<td  width="10%">&nbsp;
                    	
                    </td>
                    <td align="center" width="35%" style="vertical-align:bottom">                    
 						<?php
                       		mostrarfoto_ing_firma($usuario);
						?>
                    </td>
                    <td width="10%">&nbsp;
                    	
                    </td>
                    <td align="center" width="35%" style="vertical-align:bottom">                    
 						<?php
                       		mostrarfoto_ing_apoderado($usuario);
						?>
                    </td>
                    <td width="10%">&nbsp;
                    	
                    </td>
                </tr>
            	<tr>
                	<td>&nbsp;
                    	
                    </td>
                    <td style="border-top-style:dotted" align="center">                    
                        Firma del declarante <br>
                        Dni Nro: <?php echo $dni?>
                    </td>
                    <td>&nbsp;
                    	
                    </td>
                    <td style="border-top-style:dotted" align="center">                    
                        Firma del apoderado <br>
                    </td>
                    <td>&nbsp;
                    	
                    </td>
                </tr>
            </table>
		</td>
    </tr>
	<tr>
    	<td style="font-size:12px;">
        <br>
Del Reglamento General de Admisi&oacute;n Art. 80º "Para recabar su constancia de ingreso, el ingresante a una carrera profesional de la UNAT debe presentar, en la fecha que se&ntilde;ala el cronograma, los siguientes documentos" y el Art. 82º "El ingresante que no cumpla con presentar los documentos mencionados en el art. 80° de este reglamento, en los plazos establecidos, pierde autom&aacute;ticamente su ingreso a la UNAT, sin derecho a reclamo alguno. La DA informa al Consejo Universitario sobre el caso presentado para que se expida resoluci&oacute;n de anulaci&oacute;n de ingreso".
		</td>
    </tr>
</table>

<script>
function gEsCasillaActiva(idCasilla) {
    if (!document.getElementById(idCasilla)) {
        alert("El objeto no existe.\ngVerificaCasilla()");
    }
    return document.getElementById(idCasilla).checked ? "1" : "0";
}
