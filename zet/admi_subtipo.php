<?php 
	$vsqltipo = "select tipo, descripcion from admi_tipo order by descripcion ";	
	if (isset($_POST['cboTipo'])) 
		{
			$tipo = $_POST["cboTipo"];
		}
	elseif (isset($_GET['tipo'])) 
		{
			$tipo = $_GET["tipo"];
		}
	else
		{
			$tipo = '01';	
		}
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	$vsql = "call zyz_Admi_SubTipo ('". $tipo . "','','',0,'C')";		
	#echo $vsql;
	#echo $escuela;
	$rs = mysqli_query($cn_zet,	$vsql);			
	$contador = 0;
?>
<form method="post">
<table width="100%">
    <tr>
        <td width="8%">
            <strong>Tipo:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboTipo",$vsqltipo,$tipo); ?>
        </td>											
    </tr>
</table>
</form>
<table class="table table-striped"> 
	<thead>
    <tr>
        <th width="8%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th style="text-align: center">
            <strong>Descripci&oacute;n</strong>
        </th>
        <th width="7%" style="text-align: center">
            <strong>Activo</strong>
        </th>											
        <th width="10%" style="text-align: center">
            <a class="btn btn-default" href="admi_subtipo_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&tipo=<?php echo $tipo ?>"><i class="fa fa-file-o"></i></a>
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
                    echo '<a href="admi_subtipo_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[3].$rsjk[0].'">'.substr($rsjk[1],0,50).'</a>';
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
                    echo '<a class="btn btn-default" href="admi_subtipo_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[3].$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="admi_subtipo_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.$rsjk[3].$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i>';
                    echo '</a>';																								
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
<script>$('#cboTipo').css('width','60%')</script>

