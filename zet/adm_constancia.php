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
			$proceso = '0003';
		}
	#echo $proceso;
	$contador = 0;
	$vsqlproceso = "call zyz_MantenedorProcesoGeneral ('','','',0,'1900-01-01','','C')";
	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','', 'L','','C')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	#$rs = mysqli_query($cn,	$vsql);
	#echo $vsql;
?>
<form method="post">
<table width="100%" border="0">
 	<tr>
    	<td width="7%">
        	<strong>Proceso:</strong>
      	</td>
      	<td>
        	<?php MostrarComboJuanc("cboProceso",$vsqlproceso,$proceso); ?>
      	</td>																																								
    	<td width="20%" align="center">
        	<?php
				echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/postulante_exporta.php?codigo='.md5(rand()).'\')">';
            	echo 'Exp. SIGA';
				echo '</a>';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/ingresante_excel.php?codigo='.$proceso.'\')">';
            	echo 'Excel';
				echo '</a>';
			?>
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
            <th width="18%" style="text-align: center">
                <strong>Escuela</strong>
            </th>
            <th width="12%" style="text-align: center">
                <strong>Modalidad</strong>
            </th>
            <th width="5%" style="text-align: right">
                <strong>Puntaje</strong>
            </th>
            <th width="5%" style="text-align: right">
                <strong>Puesto</strong>
            </th>
            <!--
            <th width="8%" style="text-align: right">
                <strong>Estado</strong>
            </th>            
            -->
            <th width="10%" style="text-align: center">
            	<strong>Opc.</strong>
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
                    echo $contador;
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[3];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[4];
                echo '</td>';
				echo '<td align="left">';
					echo '<span style="font-size:9px">';
                    echo $rsjk[5];
					echo '</span>';
                echo '</td>';
				echo '<td align="left">';
					echo '<span style="font-size:9px">';
                    echo $rsjk[6];
					echo '</span>';
                echo '</td>';	
				echo '<td align="right">';
                    echo $rsjk[7];
                echo '</td>';	
				echo '<td align="right">';
                    echo $rsjk[8];
                echo '</td>';
				#echo '<td align="right" style="font-size:11px">';
                #    if ($rsjk[13]=='YA ENTREGADA')
				#	{
                #       echo '<span class="green_bg bg_space">';
                #        echo 'Entregada';
                #        echo '</span>';
                #    }
				#	elseif ($rsjk[13]=='VALIDADA')
				#	{
                #        echo '<span class="blue_bg bg_space">';
                #        echo 'Validada';
                #        echo '</span>';
                #    }
                #    elseif ($rsjk[13]=='SIN VALIDAR')
                #    {
                #        echo '<span class="red_bg bg_space">';
                #        echo 'Sin validar';
                #        echo '</span>';
                #    }
                #echo '</td>';
				echo '<td align="center">';
					$codigo = $proceso.'I'.$rsjk[2];				    
				    echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_constancia_imprimir_lote.php?codigo='.$codigo.'\')">';
            		echo '<i class="fa fa-print" style="border-color: #006;color: #006;"></i>';
					echo '</a>';
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    </tbody>								
</table>
<script>$('#cboProceso').css('width','100%')</script>
