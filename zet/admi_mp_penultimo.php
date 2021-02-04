<?php 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cn_zyz = conectar();
	$cn_zoz = conectar();
	$cn_zuz = conectar();
	$est = base64_decode(base64_decode($_GET["est"]));
	if ($est=='iniciar')
		{
			$vsql = "call zyz_Admi_Parametros ('". $persona . "','". $usuario . "','','G')";
			mysqli_query($cn_zyz, $vsql) or die (mysql_error());
			mysqli_close($cn_zyz);
		}
	mysqli_query($cn_zuz,"SET CHARACTER SET utf8");
	mysqli_query($cn_zuz,"SET NAMES utf8");
	$vsql = "call zyz_Admi_Parametros ('". $persona . "','". $usuario . "','','C')";
	#echo $vsql;
	$rs = mysqli_query($cn_zoz,	$vsql);			
	$rsjk = mysqli_fetch_row($rs);		
	$mensaje = $rsjk[0];
	$pasa = $rsjk[1];
	$total = $rsjk[0];
	####################################
	#####Mostrar pregunta
	####################################
	$vsql = "call zyz_Admi_Parametros ('". $persona . "','". $usuario . "','','P')";
	#echo $vsql;
	$rs_zuz = mysqli_query($cn_zuz,	$vsql);			
	$rsjk_zuz = mysqli_fetch_row($rs_zuz);		
	$banco = $rsjk_zuz[0];
	$tipo = $rsjk_zuz[1];
	$subtipo = $rsjk_zuz[2];
	$descripcion = $rsjk_zuz[3];
	$claveA = $rsjk_zuz[4];
	$claveB = $rsjk_zuz[5];
	$claveC = $rsjk_zuz[6];
	$claveD = $rsjk_zuz[7];
	$claveE = $rsjk_zuz[8];
	$numero = $rsjk_zuz[9];
	$estado = $rsjk_zuz[11];
	$total = $rsjk_zuz[10];
	$ver = $tipo.$subtipo;
	$nombretiposubtipo = nombretiposubtipo($ver);
	#echo $estado;
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
		}
		
	if ($estado==0)
		{
			$mensaje1 = 'EL EXAMEN HA FINALIZADO';
			echo '<div class="alert alert-danger">';
				echo '<strong style="font-size:17px">Aviso: </strong>';
				echo '<span style="font-size:16px">'.$mensaje1.'</span>';
			echo '</div>';
		}
	elseif ($estado==1)
		{
			$button = 'SIGUIENTE';
		}
	elseif ($estado==2)
		{
			$button = 'FINALIZAR';
		}
?>
<form  name="form" method="post" id="frmcronmod" action="admi_mp_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<?php
	if (($estado==1 or $estado==2) and $pasa==1)
		{
			echo '<table width="100%">';				
    			echo '<tr>';
					#echo '<td align="center">';			
					#	echo '<div id="reloj" class="reloj"  style="width: 150px; height: 30px; padding: 5px 10px; border: 1px solid black; font: bold 1.5em dotum, "lucida sans", arial; text-align: center; float: right; margin: 1em 3em 1em 1em;">';
					#	echo '00 : 00 : 00';
					#	echo '</div>';
					#echo '</td>';
        			echo '<td align="right">';
						echo '<progress value="'.$numero.'" max="'.$total.'"></progress>';
						echo '&nbsp;&nbsp;&nbsp;&nbsp;';
						echo '<strong style="font-size:16px;">';
						echo $numero;
						echo ' de ';
						echo $total;
						echo '</strong>';
        			echo '</td>';
    			echo '</tr>';
			echo '</table>';
			echo '<table width="100%">';
    			echo '<tr>';
        			echo '<td width="6%">';
						echo '<strong>'.$numero.'.- </strong>';
        			echo '</td>';
    				echo '<td>';
        				#echo '<textarea name="content" cols="12" rows="12" readonly="readonly" id="editor">';
							echo $descripcion;
            			#echo '</textarea>';
        			echo '</td>';
    			echo '</tr>';
				echo '<tr>';
        			echo '<td colspan="2">';
						mostrarfoto_pregunta($banco);        			
        			echo '</td>';
    			echo '</tr>';
			echo '</table>';
	echo '<table class="table">';
    	echo '<tr height="50">';
        	echo '<td width="6%">';
            	echo '<input name="oiga" type="radio" value="A" /> <strong style="color:#930">a)</strong>';
        	echo '</td>';
        	echo '<td>';
            	echo $claveA;
        	echo '</td>';
    	echo '</tr>';
		echo '<tr height="50">';
        	echo '<td>';
            	echo '<input name="oiga" type="radio" value="B" /> <strong style="color:#930">b)</strong>';
        	echo '</td>';
        	echo '<td>';
            	echo $claveB;
        	echo '</td>';
    	echo '</tr>';
		echo '<tr height="50">';
        	echo '<td>';
            	echo '<input name="oiga" type="radio" value="C" /> <strong style="color:#930">c)</strong>';
        	echo '</td>';
        	echo '<td>';
            	echo $claveC;
        	echo '</td>';
    	echo '</tr>';
		echo '<tr height="50">';
        	echo '<td>';
            	echo '<input name="oiga" type="radio" value="D" /> <strong style="color:#930">d)</strong>';
        	echo '</td>';
        	echo '<td>';
            	echo $claveD;
        	echo '</td>';
    	echo '</tr>';
		echo '<tr height="50">';
        	echo '<td>';
            	echo '<input name="oiga" type="radio" value="E" /> <strong style="color:#930">e)</strong>';
        	echo '</td>';
        	echo '<td>';
            	echo $claveE;
        	echo '</td>';
    	echo '</tr>';

  	echo '</table>';   
	echo '<table width="100%">';																	
    	echo '<tr>';
        	echo '<td align="center">';
				$cod = base64_encode(base64_encode($banco));
				$per = base64_encode(base64_encode($persona));
				$usu = base64_encode(base64_encode($usuario));
				echo '<input name="cod" type="hidden" value="'.$cod.'">';
				echo '<input name="per" type="hidden" value="'.$per.'">';
				echo '<input name="usu" type="hidden" value="'.$usu.'">';
				echo '<input name="txtTipo" type="hidden" value="U">';
				echo '<input name="cmdGrabar" type="submit" value="'.$button.'" class="btn btn-primary">';
        	echo '</td>';										  
    echo '</tr>';	
echo '</table>';
		}
?>
</form>
<script>
 	 	function actual() {
         fecha=new Date(); //Actualizar fecha.
         hora=fecha.getHours(); //hora actual
         minuto=fecha.getMinutes(); //minuto actual
         segundo=fecha.getSeconds(); //segundo actual
         if (hora<10) { //dos cifras para la hora
            hora="0"+hora;
            }
         if (minuto<10) { //dos cifras para el minuto
            minuto="0"+minuto;
            }
         if (segundo<10) { //dos cifras para el segundo
            segundo="0"+segundo;
            }
         //ver en el recuadro del reloj:
         mireloj = hora+" : "+minuto+" : "+segundo;	
				 return mireloj; 
         }
function actualizar() { //funci贸n del temporizador
   mihora=actual(); //recoger hora actual
   mireloj=document.getElementById("reloj"); //buscar elemento reloj
   mireloj.innerHTML=mihora; //incluir hora en elemento
	 }
setInterval(actualizar,1000); //iniciar temporizador
</script>