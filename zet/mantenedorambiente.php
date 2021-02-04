<?php 
	if (isset($_POST['cboLocal'])) 
		{
			$local = $_POST["cboLocal"];
		}
	elseif (isset($_GET['local']))
		{
			$local=$_GET["local"];
		}
	else
		{
			$local='001';	
		}
	$vsql = "call zyz_CAMantenedorAmbiente ('','". $local . "','',0,'','',0,'C')";		
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);		
	$vsqllocal = "call zyz_CAMantenedorLocal ('','','',0,'D')";		
	$contador = 0;
?>
<form method="post">
<table>
    <tr>
        <td>
        	<?php 
				if (substr($d,0,2)<>'12') {
					echo '<a href="administracion.php?code='.md5(md5($usuario)).'&d='.$_GET['d'].'&nav='.$nav.'" data-atras="SI">';
					echo '<i class="fa fa-mail-reply"></i>';
					echo ' Regresar</a>';
				}
			?>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="8%">
            <strong>Local:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboLocal",$vsqllocal,$local); ?>
        </td>											
    </tr>
</table>
</form>
<table class="table table-striped" width="100%"> 
	<thead>
    <tr>
        <th width="8%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th style="text-align: center">
            <strong>Descripci&oacute;n</strong>
        </th>
         <th width="7%" style="text-align: center">
            <strong>Capacidad</strong>
        </th>
        <th width="7%" style="text-align: center">
            <strong>Activo</strong>
        </th>											
        <th width="12%" style="text-align: center">
            <a class="btn btn-default" href="mantenedorambientenuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&local=<?php echo $local ?>">
            <i class="fa fa-file-o"></i>
            </a>
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
                    echo '<a href="mantenedorambientemodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$local.$rsjk[0].'">'.substr($rsjk[1],0,50).'</a>';
                echo '</td>';	
				 echo '<td align="right">';
                    echo $rsjk[3];
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
                   echo '<a class="btn btn-default" href="mantenedorambientemodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$local.$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '<a class="btn btn-default" rel="nolink" href="mantenedorambienteeliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.$local.$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																								
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
<script>$('#cboLocal').css('width','100%')</script>
