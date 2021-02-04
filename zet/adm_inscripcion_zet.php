<?php 
	$cn = conectar();	
	$proceso = $_GET["proceso"];
	#echo $proceso;
	$vsql = "call zyz_CAMantenedorPre ('". $proceso . "', '','','','','','','1900-01-01','01','','','','','','','C')";
	$rs = mysqli_query($cn,	$vsql);
	#echo $vsql; 
	$contador = 0;
?>
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_inscripcion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
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
                    echo '<a class="btn btn-default" rel="nolink" href="adm_pre_agregar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$rsjk[0].$rsjk[1].'" data-mensaje="Esta seguro de agregar el registro?"><i class="fa fa-check"></i></a>';
                    echo '</a>';    
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    </tbody>								
</table>