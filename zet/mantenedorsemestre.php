<?php 
	$vsql = "call zyz_CAMantenedorSemestre ('','','','',0,0,'C')";		
	$rs = mysqli_query($cn,	$vsql);		
	#echo $vsql;
	#$numeroregistros = mysqli_num_rows($rs); 
	if (!isset($_GET["paginaactual"]))
	{
		$paginaactual = 1;		
	}	
	else
	{
		$paginaactual = $_GET["paginaactual"];		
	}		
	$numeroregistrosxpagina = 60;
	#$totalpaginas =  ceil($numeroregistros/$numeroregistrosxpagina);
	#$registrosinicio = ($numeroregistrosxpagina * $paginaactual)-$numeroregistrosxpagina;	
	$contador = 0;
?>
<table>
    <tr>
        <td>            
            <a href="administracion.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo $nav?>" data-atras="SI"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
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
            <a class="btn btn-default" href="mantenedorsemestrenuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&paginaactual=<?php echo $paginaactual ?>"><i class="fa fa-file-o"></i></a>
        </th>
    </tr>
    </thead>
    <?php
    #mysqli_data_seek($rs,$registrosinicio); 										
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;
            if ($contador > $numeroregistrosxpagina) 
                {
                    break;
                }												
            echo '<tr>';
                echo '<td align="center">';
                    echo $rsjk[0];
                echo '</td>';
                echo '<td align="left">';
                     echo '<a href="mantenedorsemestremodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[0].'&paginaactual='.$paginaactual.'">'.substr($rsjk[1],0,50).'</a>';
                echo '</td>';						
                echo '<td align="center">';
                    if ($rsjk[2]==1){
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
                    echo '<a class="btn btn-default" href="mantenedorsemestremodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[0].'&paginaactual='.$paginaactual.'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="mantenedorsemestreeliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.$rsjk[0].'&paginaactual='.$paginaactual.'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																									
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
</form>