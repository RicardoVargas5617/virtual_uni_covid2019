<?php 
	$codigo = $_GET["codigo"];
	$proceso = substr($codigo,0,4);
	$litho = substr($codigo,4,6);

	$vsql = "call zyz_CAMantenedorLitho ('". $proceso . "', '','". $litho . "', 'M')";	
	#echo $vsql;	
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			mysqli_data_seek($rs,0);
		}	
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="adm_ficha_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>
            
            <a data-atras="SI" href="adm_ficha.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="8%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <?php echo $litho;?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Postulante:</strong>								
        </td>
        <td>
            <input name="txtPostulante" id="txtPostulante" type="text" value="<?php echo $postulante?>" style="width: 50%">
        </td>
    </tr>    																								
    <tr>
        <td align="center" colspan="2">
            <input name="codigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
    <?php mysqli_close($cn);?>
</table>
</form>
