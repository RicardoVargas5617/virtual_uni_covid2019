<?php 
	$cn_validacion = conectar();
	mysqli_query($cn_validacion,"SET CHARACTER SET utf8");
	mysqli_query($cn_validacion,"SET NAMES utf8");
	$vsql = "call zyz_Admi_GrabarPre ('','','','','','','','','',0,0,'C')";	
	#echo $vsql;
	$rs = mysqli_query($cn_validacion,	$vsql);			
	$contador=0;
?>
<table class="table table-striped"> 
	<thead>
    <tr>
        <th width="8%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th style="text-align: center">
            <strong>Apellidos y Nombres</strong>
        </th>
        <th width="12%" style="text-align: center; font-size:11px;">
            <strong>Email</strong>
        </th>
        <th width="8%" sstyle="text-align: center; font-size:11px;">
            <strong>Celular</strong>
        </th>
        <th width="8%" style="text-align: center; font-size:11px;">
            <strong>Password</strong>
        </th>
        <th width="7%" style="text-align: center; font-size:11px;">
            <strong>Condici&oacute;n</strong>
        </th>											
        <th width="16%" style="text-align: center">
           	<strong>Opciones</strong>
        </th>
    </tr>
    </thead>
    <?php									
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;
            echo '<tr>';
                echo '<td align="center">';
                    echo $rsjk[9];
                echo '</td>';
                echo '<td align="left">';
                    echo $rsjk[4];
                echo '</td>';	
				echo '<td style="text-align: center; font-size:11px;">';
                    echo $rsjk[5];
                echo '</td>';	
				echo '<td style="text-align: left; font-size:11px;">';
                    echo $rsjk[6];
                echo '</td>';
				echo '<td style="text-align: center; font-size:11px;">';
                    echo $rsjk[7];
                echo '</td>';					
                echo '<td style="text-align: center; font-size:10px;">';
                    if ($rsjk[8]==1){
                        echo '<span class="blue_bg bg_space">';
                        echo 'Validado';
                        echo '</span>';
                    }
                    else
                    {
                        echo '<span class="red_bg bg_space">';
                        echo 'Pendiente';
                        echo '</span>';
                    }
                echo '</td>';													
                echo '<td align="center">';		
					echo '<a class="btn btn-default" href="admi_validacion_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.base64_encode(base64_encode($rsjk[0])).'"><i class="fa fa-edit"></i></a>';
					if ($rsjk[8]==0){
						
                    echo '&nbsp;';
                        echo '<a class="btn btn-default" rel="nolink" href="admi_validacion_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.base64_encode(base64_encode($rsjk[0])).'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';	
                    }
					if ($rsjk[8]==1){                        						
					echo '&nbsp;';
					echo '<a class="btn btn-default" rel="nolink" href="admi_enviar_email.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.base64_encode(base64_encode($rsjk[0])).'" data-mensaje="Esta seguro de enviar email"><i class="fa fa-heart"></i></a>';
                    echo '</a>';	
                    }															
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn_validacion);
    ?>										
</table>