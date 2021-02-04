<?php 
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$modalidadadmision = substr($codigo,4,2);
	$escuela = substr($codigo,6,2);
	$vsqlescuela = "select estructura, descripcion from mae_estructura where nivel='3' order by descripcion";	
	$vsqlmodalidadadmision = "select modalidadadmision, descripcion from adm_modalidadadmision where activo=1 order by descripcion";
	
	$vsql = "call zyz_CAMantenedorVacante ('". $proceso . "', '". $modalidadadmision . "','". $escuela . "',0,1,'M')";	
	#echo $vsql;	
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$escuela = $row["estructura"];
			$modalidadadmision = $row["modalidadadmision"];
			$vacante = $row["vacante"];
			$puntajeminimo = $row["puntajeminimo"];
			$nombreescuela = nombreescuela($escuela);
			$nombremodalidadadmision = nombremodalidadadmision($modalidadadmision);
			mysqli_data_seek($rs,0);
		}	
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="adm_vacante_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>
            
            <a data-atras="SI" href="adm_vacante.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="10%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <?php echo $proceso;?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Escuela:</strong>								
        </td>
        <td>
            <?php echo $nombreescuela; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Modalidad:</strong>								
        </td>
        <td>
            <?php echo $nombremodalidadadmision; ?>
        </td>
    </tr>														
    <tr>
        <td>
            <strong>Vacantes:</strong>								
        </td>
        <td>
            <input name="txtVacante" id="txtVacante" type="text" value="<?php echo $vacante?>" style="width: 20%">
        </td>
    </tr>	 
    <!--  
    <tr>
        <td>
            <strong>Puntaje Minimo:</strong>								
        </td>
        <td>
            <input name="txtPuntaje" id="txtPuntaje" type="text" value="<?php echo $puntajeminimo?>" style="width: 20%">
        </td>
    </tr>	
    -->																						
    <tr>
        <td align="center" colspan="2">
            <input name="proceso" type="hidden" value="<?php echo $proceso;?>">
            <input name="cboEscuela" type="hidden" value="<?php echo $escuela;?>">
            <input name="cboModalidadadmision" type="hidden" value="<?php echo $modalidadadmision;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
    <?php mysqli_close($cn);?>
</table>
</form>
<script>$('#cboEscuela').css('width','70%')</script>
<script>$('#cboModalidadadmision').css('width','70%')</script>