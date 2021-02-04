<?php 
	$codigo = $_GET["codigo"];	
	$proceso = substr($codigo,0,4);
	$tipoexamen = substr($codigo,4,2);
	
	echo $codigo;
	$vsqlambiente = "call zyz_CAProcesoAmbiente ('". $proceso . "','','". $tipoexamen . "',0,'1900-01-01','','','','','D')";
	#echo $vsqlambiente;
	$contador = 0;
	$nombreproceso = nombreproceso($proceso);
	$nombretipoexamenzet = nombrecanal($tipoexamen);

?>
<form name="form" method="post" id="frmcronmod" action="adm_asigna_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_asigna.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>&tipoexamen=<?php echo $tipoexamen?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>	
<table class="table">
    <tr>
        <td width="13%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $nombreproceso; ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>Tipo examen:</strong>
        </td>
        <td>
            <?php echo $nombretipoexamenzet; ?>
        </td>											
    </tr>    
    <tr>
        <td>
            <strong>Ambiente:</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboAmbiente",$vsqlambiente,'','Si'); ?>
        </td>											
    </tr>
    <tr>
        <td colspan="2">
            <input name="codigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Agregar" class="btn btn-primary">										
        </td>											
    </tr>
</table>
</form>
