<?php 
	$cn_zyz = conectar();
	$cn_zoz = conectar();
	$vsql = "call zyz_Admi_GrabarPre ('". $persona . "','','','','','','','','',0,0,'D')";	
	#echo $vsql;
	$rs_postulante = mysqli_query($cn_zyz,	$vsql);	
	$num= mysqli_num_rows($rs_postulante); 	
	if ($num > 0)
		{
			$row = mysqli_fetch_array($rs_postulante, MYSQLI_ASSOC);
			$registro = $row["registro"];
			$pro = $row["proceso"];
			$pos = $row["postulante"];
			$cod = $pro.$pos;
			mysqli_data_seek($rs_postulante,0);
		}
	else
		{
			$registro=0;
		}
	
	#echo $registro;
	$vsqlproceso = "call zyz_MantenedorProceso ('', '','','','','','','1900-01-01',0,0,0,1,'','','','','F')";
	$rs = mysqli_query($cn_zoz,	$vsqlproceso);
	#echo $vsqlproceso;
	$contador=0;
?>
<?php
	if ($registro==0)
		{
			echo '<div class="alert alert-danger">';
			echo '<span class="semi-bold">Condici&oacute;n:</span> Pre-inscrito';
			echo '</div>';
			
			echo '<table class="table table-striped">';
			echo '<thead>';
    			echo '<tr>';
        			echo '<th width="8%" style="text-align: center">';
            			echo '<strong>C&oacute;digo</strong>';
        			echo '</th>';
        			echo '<th style="text-align: center">';
            			echo '<strong>Descripcion</strong>';
        			echo '</th>';										
        			echo '<th width="10%" style="text-align: center">';
           				echo '<strong>Inscribirse</strong>';
        			echo '</th>';
    			echo '</tr>';
    		echo '</thead>';
			while ($rsjk=mysqli_fetch_row($rs))
				{
					$contador = $contador + 1;
					echo '<tr>';
						echo '<td align="center">';
							echo $rsjk[0];
						echo '</td>';
						echo '<td align="left">';
							echo $rsjk[1];
						echo '</td>';	
													
						echo '<td align="center">';													
							echo '<a class="btn btn-default" href="admi_inscripcion_registro.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Registrar').'&proceso='.$rsjk[0].'"><i class="fa fa-edit"></i></a>';																					
						echo '</td>';																																													
					echo '</tr>';
				}
				#mysqli_close($cn_zoz);
			echo '</table>';
		}
	else
		{
			
			echo '<div class="alert alert-info">';
			echo '<span class="semi-bold">Condici&oacute;n:</span> Inscrito';
			echo '</div>';
        	echo '<table width="300">';
				echo '<tr>';
					echo '<td width="70%">';
						echo '<strong>';
						echo 'Ficha de Inscripci&oacute;n:';
						echo '</strong>';
					echo '</td>';
					echo '<td>';
						echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_post_soli.php?codigo='.$cod.'\')">';
            			echo '<i class="fa fa-print" style="border-color: #f14c28;color: #f14c28;"></i>';
						echo '</a>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>';
						echo '<strong>';
						echo 'Solicitud del postulante:';
						echo '</strong>';
					echo '</td>';
					echo '<td>';
						echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_post_solicitud.php?codigo='.$cod.'\')">';
            			echo '<i class="fa fa-print" style="border-color: #006;color: #006;"></i>';
						echo '</a>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>';
						echo '<strong>';
						echo 'Declaraci&oacute;n Jurada:';
						echo '</strong>';
					echo '</td>';
					echo '<td>';
						echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_post_dj.php?codigo='.$cod.'\')">';
            		echo '<i class="fa fa-print" style="border-color: #066;color: #066;"></i>';
					echo '</a>';
					echo '</td>';
				echo '</tr>';
			echo '</table>'; 
		}
?>
