<?php 
	require_once("zet_seg.php");
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	
	$vsqlsubtipo = "select concat(s.tipo,s.subtipo) as codigo, concat(t.descripcion, ' ----> ', s.descripcion) as descripcion from admi_tipo t inner join admi_subtipo s on t.tipo=s.tipo where t.activo=1 and s.activo=1 order by t.descripcion, s.descripcion ";	
	if (isset($_POST['cboSubTipo'])) 
		{
			$subtipo = $_POST["cboSubTipo"];
		}
	elseif (isset($_GET['subtipo'])) 
		{
			$subtipo = $_GET["subtipo"];
		}
	else
		{
			$subtipo = '0101';	
			$subtipo = '';
		}
	$a = substr($subtipo,0,2);
	$b = substr($subtipo,2,2);
	$vsql = "call zyz_Admi_Pregunta ('','". $a . "','". $b . "','1','2','3','4','5','6','7','8','9',0,0,'',0,0,'','C')";		
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);			
	$contador = 0;
?>
<form method="post">
<table width="100%">
    <tr>
        <td width="8%">
            <strong>Tipo:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboSubTipo",$vsqlsubtipo,$subtipo); ?>
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
        <th width="15%" style="text-align: center">
            <a class="btn btn-default" href="admi_banco_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&subtipo=<?php echo $subtipo ?>"><i class="fa fa-file-o"></i></a>
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
                    echo $rsjk[1];
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
                    echo '<a class="btn btn-default" href="admi_banco_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.base64_encode(base64_encode($rsjk[0])).'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
					echo '<a class="btn btn-default" href="admi_banco_foto.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Subir foto').'&clave='.base64_encode(base64_encode($rsjk[0])).'"><i class="fa fa-picture-o"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="admi_banco_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.base64_encode(base64_encode($rsjk[0])).'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i>';
                    echo '</a>';																								
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
<script>$('#cboSubTipo').css('width','100%')</script>

