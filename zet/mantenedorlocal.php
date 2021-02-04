<?php 
	require_once("zet_seg.php");
	$vsqlsede = "select sede, descripcion from mae_sede where activo=1 order by descripcion ";	
	if (isset($_GET['cboSede'])) 
		{
			$sede = $_POST["cboSede"];
		}
	elseif (isset($_GET['cboSede']))
		{
			$sede=$_GET["sede"];
		}
	else
		{
			$sede='01';	
			$sede='';
		}
	$vsql = "call zyz_CAMantenedorLocal ('','','". $sede . "',0,'C')";
	#echo $vsql;		
	$rs = mysqli_query($cn,	$vsql);			
	$contador = 0;
?>
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
        <td width="5%" valign="center">
            <strong>Sede:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboSede",$vsqlsede,$sede); ?>
        </td>											
    </tr>
</table>
<table class="table table-striped"> 
	<thead>
    <tr>
        <th width="8%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th width="75%" style="text-align: center">
            <strong>Descripci&oacute;n</strong>
        </th>
        <th width="7%" style="text-align: center">
            <strong>Activo</strong>
        </th>											
        <th width="14%" style="text-align: center">
            <a class="btn btn-default" href="mantenedorlocalnuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&sede=<?php echo $sede ?>">
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
                    echo '<a href="mantenedorlocalmodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$sede.$rsjk[0].'">'.substr($rsjk[1],0,50).'</a>';
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
                    echo '<a class="btn btn-default" href="mantenedorlocalmodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$sede.$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '<a class="btn btn-default" rel="nolink" href="mantenedorlocaleliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.$sede.$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																								
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
<script>$('#cboSede').css('width','100%')</script>
