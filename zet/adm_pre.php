<?php 
	#phpinfo();
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
	$vsql = "call zyz_CAMantenedorPre ('". $proceso . "', '','','','','','','1900-01-01','01','','','','','','','C')";
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
            <th width="5%" style="text-align: left">
                <strong>DNI</strong>
            </th>
            <th style="text-align: center">
                <strong>Apellidos y Nombres</strong>
            </th>
            <th width="20%" style="text-align: left">
                <strong>Escuela</strong>
            </th>
            <th width="15%" style="text-align: left">
                <strong>Modalidad</strong>
            </th>
            <th width="18%" style="text-align: center">
            	 <a class="btn btn-default" href="adm_pre_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&proceso=<?php echo $proceso ?>">
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
                    echo $rsjk[5];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[2];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[3];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[4];
                echo '</td>';	
				echo '<td align="center">';
					echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_post_pre.php?codigo='.$rsjk[0].$rsjk[1].'\')">';
            		echo '<i class="fa fa-print" style="border-color: blue;color: blue;"></i>';
					echo '</a>';
					echo '&nbsp;&nbsp;&nbsp';
                    echo '<a class="btn btn-default" rel="nolink" href="adm_pre_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$rsjk[0].$rsjk[1].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';    
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    </tbody>								
</table>
<script>$('#cboProceso').css('width','100%')</script>