<?php 
	require_once("zet_seg.php");
	$codigo = $_GET['codigo'];
	$vsql = "call zyz_Man_Maestro ('". $codigo . "','C','','',0)";		
	#echo $vsql;
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$rs = mysqli_query($cn,	$vsql);			
	$numeroregistros = mysqli_num_rows($rs); 
	#echo $numeroregistros;	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$titulo = $row["titulo"];
			mysqli_data_seek($rs,0);
		}
	else
		{
			$titulo = '';
		}
	//echo $numeroregistros; 
	if (!isset($_GET["paginaactual"]))
	{
		$paginaactual = 1;		
	}	
	else
	{
		$paginaactual = $_GET["paginaactual"];		
	}		
	$numeroregistrosxpagina = 20;
	$totalpaginas =  ceil($numeroregistros/$numeroregistrosxpagina);
	$registrosinicio = ($numeroregistrosxpagina * $paginaactual)-$numeroregistrosxpagina;	
	$contador = 0;
?>
<table class="table table-striped">    
	<thead>
        <tr>
            <th width="8%" style="text-align: center">
                <strong>C&oacute;digo</strong>
            </th>
            <th style="text-align: center">
                <strong>Descripci&oacute;n</strong>
            </th>
            <th width="5%" style="text-align: center">
                <strong>Activo</strong>
            </th>
            <th width="12%" style="text-align: center">
                <a class="btn btn-default" href="admi_maestro_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&codigo=<?php echo $codigo?>&paginaactual=<?php echo $paginaactual ?>"><i class="fa fa-file-o"></i></a>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
    mysqli_data_seek($rs,$registrosinicio); 										
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
                    echo '<a href="admi_maestro_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$codigo.'&clave='.$rsjk[0].'&paginaactual='.$paginaactual.'">'.substr($rsjk[1],0,80).'</a>';
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
                    echo '<a class="btn btn-default" href="admi_maestro_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$codigo.'&clave='.$rsjk[0].'&paginaactual='.$paginaactual.'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="admi_maestro_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$codigo.'&clave='.$rsjk[0].'&paginaactual='.$paginaactual.'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';											
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>
</tbody>										
</table>
<?php
	if ($numeroregistros>0)
		{
			echo '<table border="0">';
			echo '<tr>';
			echo '<td>';
			echo '<strong>P&aacute;ginas:</strong>';
			echo '</td>';
			echo '<td>';
			for ($i = 1; $i<($totalpaginas + 1); $i++)
				 {
					if ($i == $paginaactual)
						{
							echo '<b>'.$i.'</b>';
							echo '&nbsp;&nbsp;';
						}
					else 
						{
							echo '<a href="mantenedormaestro.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$codigo.'&paginaactual='.$i.'">'.$i.'</a>';
							echo '&nbsp;&nbsp;';
						}									
       			 }
			echo '</td>';
    		echo '</tr>';
			echo '</table>';
		}
?>
