<?php	
	$cn = conectar();	
	$cn_vacante = conectar();
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
	$vsql = "call zyz_CAAdmisionReporte ('". $proceso . "', '','', '35')";
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
<table width="100%">
	<tr>
    	<td width="15%">
        	<a class="btn btn-default" href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_tran_excel_imprimir.php?codigo=<?php echo $proceso ?>')">
            	<i class="fa fa-cogs"></i> EXCEL
            </a>
        </td>
    	<td align="right">
        	<?php
				$codigo = base64_encode(base64_encode($proceso));
				echo '<a class="btn btn-default" href="adm_transferir_detalle.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Transferir de proceso').'&codigo='.$codigo.'">';
				echo '<i class="fa fa-edit"></i> Transferir';
				echo '</a>';
			?>
        </td>
    </tr>
</table>
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
            <th width="5%" style="text-align: left">
                <strong>Escuela</strong>
            </th>
            <th width="18%" style="text-align: left">
                <strong>Modalidad</strong>
            </th>
            <th width="3%" style="text-align: left">
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
                    echo $rsjk[1];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[2];
                echo '</td>';
				echo '<td align="center">';
                    echo $rsjk[3];
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
				echo '<td align="center">';
					if ($rsjk[9]==1){
                        echo '<span class="orange_bg bg_space" style="font-size:9px">';
                        echo $rsjk[8];
                        echo '</span>';
                    }
                    elseif ($rsjk[9]==0){
                        echo '<span class="red_bg bg_space" style="font-size:9px">';
                        echo $rsjk[8];
                        echo '</span>';
                    }
                echo '</td>';																																					
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    </tbody>								
</table>
<script>$('#cboProceso').css('width','100%')</script>
