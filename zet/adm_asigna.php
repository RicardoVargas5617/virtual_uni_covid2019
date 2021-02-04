<?php 
	$cn_zet = conectar();
	if (isset($_GET["proceso"]))
		{
			$proceso=$_GET['proceso'];
		}		
	else
		{
			$proceso = $_POST['proceso'];
		}
	if (isset($_POST["cboTipoExamen"]))
		{
			$tipoexamen = $_POST["cboTipoExamen"];
		}
	elseif (isset($_GET["tipoexamen"]))
		{
			$tipoexamen = $_GET["tipoexamen"];
		}		
	else
		{
			$vsqltipoexamen="select canal, descripcion from admi_canal where activo=1 order by descripcion limit 1";
			#echo $vsqltipoexamen;
			$rs_zet  = mysqli_query($cn_zet,	$vsqltipoexamen);	
			$rsjk_zet = mysqli_fetch_row($rs_zet);	
			$tipoexamen = $rsjk_zet[0];			
		}
	#echo $vsql;
	#echo $tipoexamen;
	$codigo=$proceso.$tipoexamen;
	$vsqltipoexamen="select canal, descripcion from admi_canal where activo=1 order by descripcion";
	$vsql = "call zyz_CAProcesoAmbiente ('". $proceso . "','','". $tipoexamen . "',0,'1900-01-01','','','','','C')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);			
	$contador = 0;
	$total = 0;
	$nombreproceso = nombreproceso($proceso);
?>
<form method="post">
<table>
    <tr>
        <td>            
            <a href="adm_asignacion.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>" data-atras="SI"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
	<tr>
        <td width="12%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $nombreproceso ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>Tipo examen:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboTipoExamen",$vsqltipoexamen,$tipoexamen); ?>
        </td>											
    </tr>
</table>
<input type="hidden" name="proceso" value="<?php echo $proceso?>" />
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
        <th width="20%" style="text-align: left">
            <strong>Supervisor</strong>
        </th>
        <th width="30%" style="text-align: left">
            <strong>Aula Virtual</strong>
        </th>	
        <th width="5%" style="text-align: center">
            <strong>Cap.</strong>
        </th>											
        <th width="10%" style="text-align: center">
            <a class="btn btn-default" href="adm_asigna_nuevo.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&codigo=<?php echo $proceso.$tipoexamen?>"><i class="fa fa-file-o"></i></a>
        </th>
    </tr>					
    </thead>
    <?php							
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;	
			$total = $total + $rsjk[3];				
            echo '<tr>';
                echo '<td align="center">';
                    echo $contador;
                echo '</td>';
                echo '<td align="left">';
					echo $rsjk[2];
                echo '</td>';						
				echo '<td align="left">';
					echo $rsjk[4];
                echo '</td>';
				echo '<td align="left">';
					echo $rsjk[5];
                echo '</td>';	
				echo '<td align="right">';
					echo $rsjk[3];
                echo '</td>';												
                echo '<td align="center">';
				    echo '<a class="btn btn-default" href="adm_asigna_modificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&codigo='.$codigo.$rsjk[1].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';	
                    echo '<a class="btn btn-default" rel="nolink" href="adm_asigna_eliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.$codigo.$rsjk[1].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																									
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
		echo '<tr>';
            echo '<td align="right" colspan="4">';
                echo 'TOTAL';
            echo '</td>';
			echo '<td align="right" colspan="1">';
				echo '<strong>';
                echo $total;
				echo '</strong>';
            echo '</td>';
			echo '<td align="right">';
                echo '';
            echo '</td>';
		echo '</tr>';
    ?>										
</table>