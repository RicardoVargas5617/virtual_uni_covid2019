<?php 
	$sede = $_GET["sede"];
	$vsqlsede = "select sede, descripcion from mae_sede order by descripcion ";	
?>
<form name="form" method="post" id="frmcronmod" action="mantenedorlocalgrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>"  onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="mantenedorlocal.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&sede= <?php echo $sede?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>	
<table class="table">
    <tr>
        <td width="8%">
            <strong>C&oacute;digo</strong>
        </td>
        <td>
            <input name="hidCodigo" id="hidCodigo" data-requerido="true" data-requerido-texto="Codigo" type="text" value="" size="10" maxlength="3">
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Descripci&oacute;n</strong>								
        </td>
        <td>
            <input name="txtDescripcion" id="txtDescripcion" data-requerido="true" data-requerido-texto="Descripcion" type="text" value="" size="70">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Sede</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboSede",$vsqlsede,$sede,'No'); ?>
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
        <td align="center" colspan="2">
            <input name="hidSede" type="hidden" value="<?php echo $sede;?>">											
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