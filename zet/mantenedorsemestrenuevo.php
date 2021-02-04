<?php 
	$paginaactual = $_GET["paginaactual"];
	$contador = 0;
	$vsqldia = "select dia, dia from mae_dia order by dia";
	$vsqlmes = "select mes, descripcion from mae_mes order by mes";
	$vsqlanio = "select anio, anio from mae_anio order by anio";	
	$dia = date("d");
	$mes = date("m");
	$anio = date("Y");
	$diainicio = date("d");
	$mesinicio = date("m");
	$anioinicio = date("Y");	
?>
<form name="form" method="post" id="frmcronmod" action="mantenedorsemestregrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>"  onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>
            
            <a data-atras="SI" href="mantenedorsemestre.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&paginaactual=<?php echo $paginaactual?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>	
<table class="table">
    <tr>
        <td width="20%">
            <strong>C&oacute;digo</strong>
        </td>
        <td width="80%">
            <input name="hidCodigo" type="text" value="" maxlength="6" size="12">
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Descripci&oacute;n</strong>								
        </td>
        <td>
            <input name="txtDescripcion" type="text" value="" size="70">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Fecha Inicio</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboDia",$vsqldia,$dia,'Si'); ?>
            <?php MostrarComboZet("cboMes",$vsqlmes,$mes,'Si'); ?>
            <?php MostrarComboZet("cboAnio",$vsqlanio,$anio,'Si'); ?>
        </td>
    </tr>											
    <tr>
        <td>
            <strong>Fecha Fin</strong>								
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
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" checked>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Vigente</strong>								
        </td>
        <td>
            <input name="chkVigente" id="chkVigente" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" checked>
        </td>
    </tr>																																		
    <tr>
        <td align="center" colspan="2">
            <input name="hidPaginaActual" type="hidden" value="<?php echo $paginaactual;?>">
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
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