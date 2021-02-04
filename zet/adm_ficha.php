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
	$vsql = "call zyz_CAMantenedorLitho ('". $proceso . "', '','', 'C')";
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
<!--
<table width="100%">
	<tr>
    	<td align="right">
        	<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_postulante_imprimir.php?codigo=<?php echo $proceso ?>')">
            <i class="fa fa-print squre semiround icon_size4 " style="border-color: #006;color: #006;">
            </i>
            </a> 
            &nbsp;&nbsp;&nbsp;
            <a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_postulanteno_imprimir.php?codigo=<?php echo $proceso ?>')">
            <i class="fa fa-print squre semiround icon_size4 " style="border-color: #900;color: #900;">
            </i>
            </a>  
        </td>
    </tr>
</table>	
-->		
</form>
<table class="table table-striped">
	<thead>
        <tr>
        	<th width="6%" style="text-align: center">
                <strong>Nro.</strong>
            </th>
            <th width="10%" style="text-align: left">
                <strong>C&oacute;digo</strong>
            </th>
            <th width="10%" style="text-align: left">
                <strong>Litho</strong>
            </th>
            <th style="text-align: center">
                <strong>Apellidos y Nombres</strong>
            </th>
            <th width="5%" style="text-align: left">
                <strong>Escuela</strong>
            </th>
            <th width="5%" style="text-align: left">
                <strong>Examen</strong>
            </th>
            <th width="5%" style="text-align: right">
                <strong>Total</strong>
            </th>
            <th width="5%" style="text-align: right">
                <strong>Observado</strong>
            </th>
            <th width="6%" style="text-align: center">
            </th>
        </tr>
    </thead>
    <tbody>
    <?php							
    while ($rsjk=mysqli_fetch_row($rs))
        {
            echo '<tr>';
			    $contador = $contador + 1;
			 	echo '<td align="left">';
					echo '<strong>';
                    echo $contador;
					echo '</strong>';
					echo '<span style="color:azul;font-size:11px;">';
					echo ' (';
					echo $rsjk[10];
					echo ')';
					echo '</span>';
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[1];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[2];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[3];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[11];
                echo '</td>';	
				echo '<td align="center">';
                    echo $rsjk[6];
                echo '</td>';	
				echo '<td align="center">';
                    echo $rsjk[8];
                echo '</td>';	
				echo '<td align="center">';
                    if ($rsjk[9]==0){
                        echo '<span class="blue_bg bg_space">';
                        echo 'No';
                        echo '</span>';
                    }
                    else
                    {
                        echo '<span class="red_bg bg_space">';
                        echo 'Si';
                        echo '</span>';
                    }
                echo '</td>';
				echo '<td align="center">';
               		echo '<a class="btn btn-default" href="adm_ficha_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$rsjk[0].$rsjk[2].'"><i class="fa fa-edit"></i></a>';
                    echo '</a>';    
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    </tbody>								
</table>
<script>$('#cboProceso').css('width','100%')</script>
