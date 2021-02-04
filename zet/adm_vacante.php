<?php 
	$cn = conectar();	
	$cn_vacante = conectar();
	$vsqlsede = "select sede, descripcion from mae_sede order by descripcion ";	
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
	$total = 0;
	$vsqlproceso = "call zyz_MantenedorProceso ('', '','','','','','','1900-01-01',0,0,0,1,'','','','','D')";
	#echo $vsqlproceso;
	$vsql = "call zyz_CAMantenedorVacante ('". $proceso . "', '','',0,1,'C')";
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
<table class="table table-striped">
	<thead>
        <tr>
        	<th width="4%" style="text-align: center">
                <strong>Nro.</strong>
            </th>
            <th style="text-align: left">
                <strong>Escuela</strong>
            </th>
            <th width="20%" style="text-align: left">
                <strong>Modalidad</strong>
            </th>
            <th width="6%" style="text-align: center">
                <strong>Vacantes</strong>
            </th>
            <th width="12%" style="text-align: center">
            	 <a class="btn btn-default" href="adm_vacante_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&proceso=<?php echo $proceso ?>">
            	<i class="fa fa-file-o"></i>
            	</a>
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
				echo '<td align="right">';
					$total = $total + $rsjk[3];
                    echo $rsjk[3];
                echo '</td>';	
				echo '<td align="center">';
               		echo '<a class="btn btn-default" href="adm_vacante_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$rsjk[0].$rsjk[4].$rsjk[5].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="adm_vacante_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$rsjk[0].$rsjk[4].$rsjk[5].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';    
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    	<tr>
        	<td colspan="3" align="right">
            	<strong>      
            	TOTAL:  
                </strong>    
            </td>
            <td align="right">
            	<strong>
            	<?php echo $total;?>
                </strong>
            </td>
            <td>            
            </td>        
        </tr>
    </tbody>								
</table>
<script>$('#cboProceso').css('width','100%')</script>