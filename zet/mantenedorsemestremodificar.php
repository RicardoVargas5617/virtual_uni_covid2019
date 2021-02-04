<?php 
	$codigo = $_GET["clave"];
	$paginaactual = $_GET["paginaactual"];
	$vsql = "call zyz_CAMantenedorSemestre ('". $codigo . "','','','',0,0,'M')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$rsjk = mysqli_fetch_row($rs);	
	$vsqldia = "select dia, dia from mae_dia order by dia";
	$vsqlmes = "select mes, descripcion from mae_mes order by mes";
	$vsqlanio = "select anio, anio from mae_anio order by anio";
	$descripcion = $rsjk[1];
	$inicio = $rsjk[2];
	$fin = $rsjk[3];
	$dia = substr($rsjk[2],0,2);
	$mes = substr($rsjk[2],3,2);
	$anio = substr($rsjk[2],6,4);	
	$diainicio = substr($rsjk[3],0,2);
	$mesinicio = substr($rsjk[3],3,2);
	$anioinicio = substr($rsjk[3],6,4);		
	$activo = $rsjk[4];
	$vigente = $rsjk[5];
	$contador = 0;

?>
<form name="form" method="post" id="frmcronmod" action="mantenedorsemestregrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="mantenedorsemestre.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&paginaactual=<?php echo $paginaactual?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>					
<table border="0" align="left" width="60%" class="table">
    <tr>
        <td width="8%">
            <strong>C&oacute;digo</strong>
        </td>
        <td width="400">
            <input name="txtCodigo" type="text" value="<?php echo $codigo ?>" size="8" maxlength="6" readonly="true">
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Descripci&oacute;n</strong>								
        </td>
        <td>
            <input name="txtDescripcion" type="text" value="<?php echo $descripcion ?>" size="70">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Inicio:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboDia",$vsqldia,$dia,'Si'); ?>
            <?php MostrarComboZet("cboMes",$vsqlmes,$mes,'Si'); ?>
            <?php MostrarComboZet("cboAnio",$vsqlanio,$anio,'Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Fin</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboDiaFin",$vsqldia,$diainicio,'Si'); ?>
            <?php MostrarComboZet("cboMesFin",$vsqlmes,$mesinicio,'Si'); ?>
            <?php MostrarComboZet("cboAnioFin",$vsqlanio,$anioinicio,'Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Activo</strong>								
        </td>
        <td>
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" <?php if ($activo==1) {echo "checked";} ?>>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Vigente</strong>								
        </td>
        <td>
            <input name="chkVigente" id="chkVigente" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" <?php if ($vigente==1) {echo "checked";} ?>>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="hidCodigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="hidPaginaActual" type="hidden" value="<?php echo $paginaactual;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
    <?php mysqli_close($cn);?>
</table>
</form>
<script>
function gEsCasillaActiva(idCasilla) {
    if (!document.getElementById(idCasilla)) {
        alert("El objeto no existe.\ngVerificaCasilla()");
    }
    return document.getElementById(idCasilla).checked ? "1" : "0";
}
</script>