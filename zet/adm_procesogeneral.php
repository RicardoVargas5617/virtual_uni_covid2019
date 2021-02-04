<?php 
	$vsql = "call zyz_MantenedorProcesoGeneral ('','','',0,'1900-01-01','','C')";		
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);		
	$contador = 0;
?>
<table class="table table-striped"> 
	<thead>
    <tr>
        <th width="10%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th style="text-align: center">
            <strong>Descripci&oacute;n</strong>
        </th>
        <th width="7%" style="text-align: center">
            <strong>Activo</strong>
        </th>											
        <th width="10%" style="text-align: center">
            <a class="btn btn-default" href="adm_procesogeneral_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>"><i class="fa fa-file-o"></i></a>
        </th>
    </tr>
    </thead>
    <?php
    #mysqli_data_seek($rs,$registrosinicio); 										
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;									
            echo '<tr>';
                echo '<td align="center">';
                    echo $rsjk[0];
                echo '</td>';
                echo '<td align="left">';
                     echo '<a href="adm_procesogeneral_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[0].'">'.substr($rsjk[1],0,50).'</a>';
                echo '</td>';						
                echo '<td align="center">';
                    if ($rsjk[3]==1){
                        echo '<span class="blue_bg bg_space">';
                        echo 'Activo';
                        echo '</span>';
                    }
                    else
                    {
                        echo '<span class="red_bg bg_space">';
                        echo 'Inactivo';
                        echo '</span>';
                    }
                echo '</td>';													
                echo '<td align="center">';													
                    echo '<a class="btn btn-default" href="adm_procesogeneral_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="adm_procesogeneral_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																									
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
</form>