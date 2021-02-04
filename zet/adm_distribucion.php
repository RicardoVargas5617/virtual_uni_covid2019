<?php	
	$cn = conectar();	
	$cn_zyz = conectar();	
	$nombreproceso = nombreproceso($proceso);
	$contador = 0;
	$vsql = "call zyz_CAProcesoAmbiente ('". $proceso . "','','',0,'1900-01-01','','','','','H')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$num = mysqli_num_rows($rs);
	#echo $vsql;
	
	$vsql = "call zyz_CAProcesoAmbiente ('". $proceso . "','','',0,'1900-01-01','','','','','I')";
	$rszet = mysqli_query($cn_zyz,	$vsql);			
	#echo $vsql;
?>
<table>
    <tr>
        <td>            
            <a href="adm_asignacion.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<div class="alert alert-success">
	<a class="btn btn-default" href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_post_imprimir.php?codigo=<?php echo $proceso ?>')">
  	<i class="fa fa-print"></i>
    </a>
	<span class="semi-bold">
    PROCESO: <?php echo $nombreproceso;?>
    </span>
</div>
<table class="table table-striped">
	<thead>
        <tr>
        	<th width="4%" style="text-align: center">
                <strong>Nro.</strong>
            </th>
            <th width="12%" style="text-align: center">
                <strong>Tipo examen</strong>
            </th>
            <th width="9%" style="text-align: right">
                <strong>Total</strong>
            </th>
            <th style="text-align: center">
                <strong>Ambientes</strong>
            </th>
            <th width="9%" style="text-align: right">
                <strong>Capacidad</strong>
            </th>
            <th width="12%" style="text-align: center">
 				Valido	
             </th>
        </tr>
    </thead>
    <tbody>
    <?php				
	$total=0;
	$totalambiente=0;		
	$pasa=0;
	$procesado=0;	
    while ($rsjk=mysqli_fetch_row($rs))
        {
            echo '<tr>';
			    $contador = $contador + 1;
				$total = $total + $rsjk[1];
				$totalambiente = $totalambiente + $rsjk[3];
				$pasa = $pasa + $rsjk[4];
				$procesado = $procesado + $rsjk[5];
			 	echo '<td align="center">';
                    echo $contador;
                echo '</td>';
                echo '<td align="center">';
                    echo $rsjk[0];
                echo '</td>';
				echo '<td align="right">';
                    echo $rsjk[1];
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk[2];
                echo '</td>';
				echo '<td align="right">';
                    echo $rsjk[3];
                echo '</td>';	
				echo '<td align="center">';
                    if ($rsjk[4]==0){
                        echo '<span class="blue_bg bg_space">';
                        echo 'Valido';
                        echo '</span>';
                    }
                    else
                    {
                        echo '<span class="red_bg bg_space">';
                        echo 'Invalido';
                        echo '</span>';
                    }
                echo '</td>';																																					
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>		
    	<tr>
        	<td colspan="2" align="right">
            	<strong>
                TOTAL
                </strong>
            </td>
            <td align="right">
            	<strong>
            	<?php echo $total?>
                </strong>
            </td>
            <td align="right">
            	<strong>
                TOTAL
                </strong>
            </td>
            <td align="right">
            	<strong>
            	<?php echo $totalambiente?>
                </strong>
            </td>
            <td>&nbsp;
            	
            </td>
        </tr>
    </tbody>								
</table>

<?php 
	#echo $procesado;
	if ($pasa==0 and $num>0)
		{
			if ($procesado>=1)
				{
					echo '<div class="alert alert-warning">';
					echo '<span class="semi-bold">';
					echo 'Ya existe una distribuci&oacute;n, si procesa nuevamente se borrar&aacute; la distribuci&oacute;n anterior y se generar&aacute;n una nueva.';
					echo '</span>';
					echo '</div>';	
				}
			echo '<form name="frm" method="post" id="frm" action="adm_distribucion_grabar.php?code='.md5(md5($usuario)).'&d='.$_GET['d'].'&nav='.$_GET['nav'].'" onsubmit="grabar(this.id);return false;">';
			echo '<table width="100%">';
				echo '<tr>';
					echo '<td align="center">';
			echo '<input type="hidden" name="proceso" value="'.$proceso.'"/>';
			echo '<input name="cmdGrabar" type="submit" value="Distribuir aleatoriamente" class="btn btn-primary">';
					echo '</td>';
				echo '</tr>';
			echo '</table>';	
			echo  '</form>';
		}
	else
		{
			echo '<div class="alert alert-danger">';
			echo '<span class="semi-bold">';
    		echo 'No se puede procesar, no coinciden los totales';
    		echo '</span>';
			echo '</div>';
		}
?>
<div class="alert alert-success">
	<span class="semi-bold">
    Ambientes
    </span>
</div>
<table class="table table-striped">
	<thead>
        <tr>
        	<th width="4%" style="text-align: center">
                <strong>Nro.</strong>
            </th>
            <th width="12%" style="text-align: center">
                <strong>Ambiente</strong>
            </th>
            <th style="text-align: left">
                <strong>Tipo examen</strong>
            </th>
            <th width="9%" style="text-align: right">
                <strong>Capacidad</strong>
            </th>
            <th width="12%" style="text-align: center">
            	<?php
 					echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_dist.php?codigo='.$proceso.'\')">';
            		echo '<i class="fa fa-print" style="border-color: #006;color: #006;"></i>';
					echo '</a>';
					echo '&nbsp;&nbsp;';
					echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_dist_excel.php?codigo='.$proceso.'\')">';
            		echo '<i class="fa fa-print"></i> Excel';
					echo '</a>';
				?>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php		
	$contador=0;	
	$total=0;				
    while ($rsjk_zet=mysqli_fetch_row($rszet))
        {
            echo '<tr>';
			    $contador = $contador + 1;
				$total = $total + $rsjk_zet[2];
			 	echo '<td align="center">';
                    echo $contador;
                echo '</td>';
                echo '<td align="center">';
                    echo substr($rsjk_zet[0],3);
                echo '</td>';
				echo '<td align="left">';
                    echo $rsjk_zet[1];
                echo '</td>';
				echo '<td align="right">';
                    echo $rsjk_zet[2];
                echo '</td>';
				echo '<td align="center">';
                    echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_ambiente.php?codigo='.$proceso.$rsjk_zet[0].'\')">';
            		echo '<i class="fa fa-print" style="border-color: #006;color: #006;"></i>';
					echo '</a>';
					echo '&nbsp;';
					echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_ambiente_listado.php?codigo='.$proceso.$rsjk_zet[0].'\')">';
            		echo '<i class="fa fa-print" style="border-color: #9C3;color: #9C3;"></i>';
					echo '</a>';
					echo '&nbsp;';
					echo '<a href="javascript:ventanaSecundaria(\''.GL_DIR_WS_HTTP_APP.'zet/adm_ambiente_excel.php?codigo='.$proceso.$rsjk_zet[0].'\')">';
            		echo '<i class="fa fa-print"></i> Excel';
					echo '</a>';
                echo '</td>';																																	
            echo '</tr>';
        }
        mysqli_close($cn_zyz);
    ?>		
    	<tr>
        	<td colspan="3" align="right">
            	<strong>
                TOTAL
                </strong>
            </td>
            <td align="right">
            	<strong>
            	<?php echo $total?>
                </strong>
            </td>
            <td>&nbsp;
            	
            </td>
        </tr>
    </tbody>								
</table>