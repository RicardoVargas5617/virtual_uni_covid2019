<?php	
	$cn = conectar();	
	$cn_vacante = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	mysqli_query($cn_vacante,"SET CHARACTER SET utf8");
	mysqli_query($cn_vacante,"SET NAMES utf8");
	if (isset($_POST['cboProceso'])) 
		{
			$proceso = $_POST["cboProceso"];
		}
	elseif (isset($_GET['proceso'])) 
		{
			$proceso = $_GET["proceso"];
		}
	else
		{
			$vsql_vacante = "call zyz_MantenedorProceso ('', '','','','','','','1900-01-01',0,0,0,1,'','','','','E')";
			#echo $vsql_vacante;			
			$rs_vacante = mysqli_query($cn_vacante, $vsql_vacante);
			$num= mysqli_num_rows($rs_vacante); 	
			if ($num > 0)
				{
					$row_vacante = mysqli_fetch_array($rs_vacante, MYSQLI_ASSOC);
					$proceso =  $row_vacante["proceso"];
				}
		}
	#echo $proceso;
	$contador = 0;
	$vsqlproceso = "call zyz_MantenedorProceso ('', '','','','','','','1900-01-01',0,0,0,1,'','','','','D')";		
	#echo $vsqlproceso;
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '34')";
	$rs = mysqli_query($cn,	$vsql);
	#echo $vsql;
?>
<form method="post">
<table class="table">
 	<tr>
    	<td width="8%">
        	<strong>Proceso:</strong>
      	</td>
      	<td>
        	<?php MostrarComboJuanc("cboProceso",$vsqlproceso,$proceso); ?>
      	</td>																																								
  	</tr>																			
</table>	
</form>
<table class="table table-striped" border="0">
	<thead>
        <tr>
        	<th width="4%" style="text-align: center">
                <strong>Nro.</strong>
            </th>
            <th width="7%" style="text-align: center">
                <strong>C&oacute;digo</strong>
            </th>
            <th style="text-align: center">
                <strong>Apellidos y Nombres</strong>
            </th>
            <th width="8%" style="text-align: center">
                <strong>Escuela</strong>
            </th>
            <th width="12%" style="text-align: center">
                <strong>Modalidad</strong>
            </th>
            <th width="3%" style="text-align: center">
                <strong>Tipo</strong>
            </th>
            <th width="5%" style="text-align: right">
                <strong>Puesto</strong>
            </th>
            <th width="5%" style="text-align: right">
                <strong>Puntaje</strong>
            </th>
            <th width="12%" style="text-align: center">
                <strong>Condici&oacute;n</strong>
            </th>
            <th width="7%" style="text-align: center">
            	<strong>EXA/CON</strong>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php							
    while ($rsjk=mysqli_fetch_row($rs))
        {
            echo '<tr>';
			    $contador = $contador + 1;
			 	echo '<td align="center">';
					echo '<strong>';
                    echo $contador;					
					echo '</strong>';
					echo '&nbsp;';
					echo '<sub>';
					echo '(';
					echo $rsjk[12];
					echo ')';
					echo '</sub>';
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[10];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[2];
                echo '</td>';
				echo '<td align="center">';
                    echo $rsjk[11];
                echo '</td>';
				echo '<td align="left">';
					echo '<span style="font-size:9px">';
                    echo $rsjk[4];
					echo '</span>';
                echo '</td>';	
				echo '<td align="center">';
                    echo $rsjk[5];
                echo '</td>';	
				echo '<td align="right">';
                    echo $rsjk[6];
                echo '</td>';
				echo '<td align="right">';
					if ($rsjk[9]==2){
						echo '<strong>';
                    	echo $rsjk[7];
						echo '<strong>';
					}
					else
					{
						echo $rsjk[7];
					}
                echo '</td>';	
				echo '<td align="center" style="font-size:10px;">';
                    if ($rsjk[9]==2){
                        echo '<span class="blue_bg bg_space">';
                        echo $rsjk[8];
                        echo '</span>';
                    }
					elseif ($rsjk[9]==1){
                        echo '<span class="orange_bg bg_space">';
                        echo $rsjk[8];
                        echo '</span>';
                    }
                    elseif ($rsjk[9]==0){
                        echo '<span class="red_bg bg_space">';
                        echo $rsjk[8];
                        echo '</span>';
                    }
                echo '</td>';
				echo '<td align="center">';
					$cod = base64_encode(base64_encode($rsjk[0].$rsjk[1]));
					if ($rsjk[9]==2 or $rsjk[9]==1)
						{
				    echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_post_respuesta.php?codigo='.$cod.'\')">';
            		echo '<i class="fa fa-print squre semiround icon_size4" style="border-color: #006;color: #006;"></i>';
					echo '</a>';
						}
					#if ($rsjk[9]==2)
					#	{
					#		echo '&nbsp;';
					#		echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_ing_constancia.php?codigo='.$cod.'\')">';
					#		echo '<i class="fa fa-print squre semiround icon_size4" style="border-color: #066;color: #066;"></i>';
					#		echo '</a>';
					#	}	
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    </tbody>								
</table>
<script>$('#cboProceso').css('width','100%')</script>
