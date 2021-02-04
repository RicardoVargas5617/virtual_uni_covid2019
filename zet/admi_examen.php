<?php 
	$cn = conectar();
	$cn_pregunta = conectar();
	#mysqli_query($cn,"SET CHARACTER SET utf8");
	#mysqli_query($cn,"SET NAMES utf8");
	$vsql = "call zyz_Admi_Parametros ('". $persona . "','". $usuario . "','". $proceso . "','C')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);			
	$rsjk = mysqli_fetch_row($rs);		
	$mensaje = $rsjk[0];
	$pasa = $rsjk[1];
	$total = $rsjk[2];
	$totalfalta = $rsjk[3];
	
	#######sesiones
	#echo $persona;
	#echo '<br>';
	#echo $usuario;
	#echo '<br>';
	#echo $vescuela
	$codigozet=$proceso.$vescuela.$persona;
	$codigozet=base64_encode(base64_encode($codigozet));
?>
<?php
	#echo $total;
	if ($pasa==0)
		{
			echo '<div class="alert alert-danger">';
				echo '<strong style="font-size:17px">Aviso: </strong>';
				echo '<span style="font-size:16px">'.$mensaje.'</span>';
			echo '</div>';
		}
	elseif ($pasa==1)
		{
			echo '<div class="alert alert-info">';
				echo '<strong style="font-size:17px">Aviso: </strong>';
				echo '<span style="font-size:16px">'.$mensaje.'</span>';
			echo '</div>';
			if ($total == 0)
				{
					$estado = base64_encode(base64_encode('iniciar'));
					####### mostrarlas pregunta ######
					#################################
					mysqli_query($cn_pregunta,"SET CHARACTER SET utf8");
					mysqli_query($cn_pregunta,"SET NAMES utf8");
					
					$vsql_pregunta = "call zyz_Admi_EstructuraPostulante ('". $persona . "','". $proceso . "','','','',0,'". $vescuela . "','A')";
					#echo $vsql_pregunta;
					$rs_pregunta = mysqli_query($cn_pregunta, $vsql_pregunta);
					$contador = 0;
					echo '<table class="table table-striped">';
						echo '<thead>';
							echo '<tr>';
								echo '<th style="text-align: center">';
									echo '<strong>Tipo de pregunta</strong>';
								echo '</th>';
								echo '<th width="10%" style="text-align: center">';
									echo '<strong># Preguntas</strong>';
								echo '</th>';
								echo '<th width="10%" style="text-align: center">';
									echo '<strong>Orden</strong>';
								echo '</th>';
							echo '</tr>';
						echo '</thead>';
						$totalpreguntas = 0;
						while ($rsjk_pregunta=mysqli_fetch_row($rs_pregunta))
							{
								$contador = $contador + 1;
								echo '<tr>';
									echo '<td align="left">';
										echo $rsjk_pregunta[1];
									echo '</td>';
									echo '<td align="center">';
										$totalpreguntas = $totalpreguntas + $rsjk_pregunta[2];
										echo $rsjk_pregunta[2];
									echo '</td>';						
									echo '<td align="center">';
										echo $rsjk_pregunta[3];																										
								echo '</tr>';
							}
        					mysqli_close($cn_pregunta);
							echo '<tr>';
									echo '<td align="right">';
										echo '<strong>';
										echo 'TOTAL:';
										echo '</strong>';
									echo '</td>';
									echo '<td align="center">';
										echo '<strong>';
										echo $totalpreguntas;
										echo '</strong>';
									echo '</td>';						
									echo '<td align="center">';
										'';																										
								echo '</tr>';
					echo '</table>';					
					################################
					###############################
					$mensaje_pregunta = 'Ese es el orden de preguntas para su examen de admisi&oacute;n, si desea cambiarlo haga clic aqu&iacute;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';					
					echo '<div class="alert alert-warning">';
						echo '<strong style="font-size:14px">Aviso: </strong>';
						echo '<span style="font-size:13px">'.$mensaje_pregunta;
						#echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_post_total_pdf.php?c1='.$codigozet.'\')">';
            			#echo 'Cambiar orden de las preguntas.';
						#echo '</a>';
						echo '<a class="btn btn-default" href="admi_examen_pregunta.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Cambiar orden').'&c1='.$codigozet.'">';
						echo 'Cambiar orden de las preguntas';
						echo '</a>';
                    echo '&nbsp;';
						echo '</span>';
					echo '</div>';
					
					echo '<a class="btn btn-default" href="admi_mp.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Pregunta').'&est='.$estado.'">';
					echo 'Iniciar examen';
					echo '</a>';
				}
			else
				{
					if ($totalfalta == 0)
						{
							$mensaje = 'EL EXAMEN HA FINALIZADO.';
							echo '<div class="alert alert-info">';
								echo '<strong style="font-size:17px">Aviso: </strong>';
								echo '<span style="font-size:16px">'.$mensaje.'</span>';
							echo '</div>';
						}
					else
						{
							$estado = base64_encode(base64_encode('continuar'));
							echo '<a class="btn btn-default" href="admi_mp.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Pregunta').'&est='.$estado.'">';
							echo 'Continuar examen';
							echo '</a>';							
						}
				}
		}
?>
