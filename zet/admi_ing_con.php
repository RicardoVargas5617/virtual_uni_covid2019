<?php 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cn_zyz = conectar();
	$cn_zoz = conectar();
	#echo $persona;
	#echo $usuario;
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
	$validado  = $rsjk[10];
	#$validado = 1;
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="admi_ing_dj_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<?php
	if ($validado==0)
		{
			echo '<table width="100%">';
					echo '<tr>';
						echo '<td width="20%">';
							echo '&nbsp;';
						echo '</td>';
						echo '<td>';
							echo '<div class="alert alert-danger">';
							echo '<span style="font-size:16px;">Luego de aceptar la Declaraci&oacute;n Jurada, comun&iacute;quese con la Direcci&oacute;n de Admisi&oacute;n <strong>979332963, 960054974, 937376420,</strong> para poder descargar su <strong>Constancia de Ingreso.</strong></span>';
							echo '</div>';
						echo '</td>';
						echo '<td width="20%">';
							echo '&nbsp;';
						echo '</td>';							
					echo '</tr>';					
				echo '</table>';		
		}
	else
		{
			echo '<table width="100%">';
					echo '<tr>';
						echo '<td width="20%">';
							echo '&nbsp;';
						echo '</td>';
						echo '<td align="center">';
							echo '<div class="alert alert-info">';
							echo '<span class="semi-bold" style="font-size:16px;">DESCARGUE SU CONSTANCIA DE INGRESO</span>';
							echo '</div>';
						echo '</td>';
						echo '<td width="20%">';
							echo '&nbsp;';
						echo '</td>';							
					echo '</tr>';
					echo '<tr>';
						echo '<td width="20%">';
							echo '&nbsp;';
						echo '</td>';
						echo '<td align="center">';
							$codigo = '0003I'.$persona;
							#base64_encode(base64_encode($rsjk[0].$rsjk[1].$rsjk[2]));
						   echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_constancia_imprimir_lote.php?codigo='.$codigo.'\')">';
							echo '<i class="fa fa-print squre semiround icon_size4" style="border-color: #006;color: #006;"></i>';
							echo '</a>';
						echo '</td>';
						echo '<td width="20%">';
							echo '&nbsp;';
						echo '</td>';							
					echo '</tr>';					
				echo '</table>';
		}
	?>
    
</form>
