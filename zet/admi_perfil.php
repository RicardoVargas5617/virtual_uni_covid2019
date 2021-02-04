<?php 
	require_once("zet_seg.php");
	$cnzyz = conectar();
	$vsql = "call zyz_Man_Perfil ('','',0,'C')";		
	$rs = mysqli_query($cnzyz, $vsql);			
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
           <a class="btn btn-default" href="admi_perfil_nuevo.php?code=<?php md5(md5($usuario))?>&d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>"><i class="fa fa-file-o"></i></a>
        </th>
    </tr>
    </thead>
    <?php
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;
            echo '<tr>';
                echo '<td align="center">';
                    echo $rsjk[0];
                echo '</td>';
                echo '<td align="left">';
                    echo '<a href="admi_perfil_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$rsjk[0].'">'.substr($rsjk[1],0,70).'</a>';
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
					echo '<a class="btn btn-default" href="admi_perfil_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="admi_perfil_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																							
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cnzyz);
    ?>										
</table>