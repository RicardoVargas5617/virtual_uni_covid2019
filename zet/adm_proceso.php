<?php 
	require_once("zet_seg.php");
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$vsqlsede = "select sede, descripcion from mae_sede order by descripcion ";	
	if (isset($_POST['cboSede'])) 
		{
			$sede = $_POST["cboSede"];
		}
	elseif (isset($_GET['sede'])) 
		{
			$sede = $_GET["sede"];
		}
	$contador = 0;
	$vsql = "call zyz_MantenedorProceso ('', '". $sede . "','','','','','','1900-01-01',0,0,0,1,'','','','','C')";		
	#echo $vsql;
	$rs = mysqli_query($cnzet,	$vsql);			
	$numeroregistros = mysqli_num_rows($rs); 
?>
<form method="post">
<table class="table">
 	<tr>
    	<td width="8%">
        	<strong>Sede:</strong>
      	</td>
      	<td>
        	<?php MostrarComboJuanc("cboSede",$vsqlsede,$sede); ?>
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
            <th width="6%" style="text-align: center">
                <strong>C&oacute;digo</strong>
            </th>
            <th style="text-align: center">
                <strong>Descripci&oacute;n</strong>
            </th>
            <th width="9%" style="text-align: center">
                <strong>Semestre</strong>
            </th>
            <th width="9%" style="text-align: center">
                <strong>Tipo</strong>
            </th>
            <th width="9%" style="text-align: center">
                <strong>Activo</strong>
            </th>
            <th width="25%" style="text-align: center">
            	 <a class="btn btn-default" href="adm_proceso_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&sede=<?php echo $sede ?>">
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
                echo '<td align="center">';
                    echo $rsjk[0];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[1];
                echo '</td>';
				echo '<td align="center">';
                    echo $rsjk[2];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[3];
                echo '</td>';	
				echo '<td align="center">';
                    if ($rsjk[4]==1){
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
               		echo '<a class="btn btn-default" href="adm_proceso_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
					echo '<a class="btn btn-default" href="adm_proceso_calendario.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Configurar').'&codigo='.$rsjk[0].'"><i class="fa fa-bell-o"></i></a>';
					echo '<a class="btn btn-default" href="adm_proceso_ponercero.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Poner a 0').'&codigo='.$rsjk[0].'"><i class="fa fa-eraser"></i></a>';
                    echo '&nbsp;';
					echo '<a class="btn btn-default" href="adm_proceso_constancia.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Enviar a constancias').'&codigo='.$rsjk[0].'"><i class="fa fa-caret-square-o-right"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="adm_proceso_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';    
                echo '</td>';																																							
            echo '</tr>';
        }
        mysqli_close($cnzet);
    ?>		
    </tbody>								
</table>
<script>$('#cboSede').css('width','100%')</script>