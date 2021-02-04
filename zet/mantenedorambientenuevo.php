<?php 
	$local = $_GET["local"];
	$tipoambiente="";
	$vsqllocal = "select local, descripcion from aca_local order by descripcion ";	
	$vsqltipoambiente = "select tipoambiente, descripcion from aca_tipoambiente order by descripcion ";
?>
<form  name="form" method="post" id="frmcronmod" action="mantenedorambientegrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="mantenedorambiente.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&local=<?php echo $local?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="8%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <input name="hidCodigo" id="hidCodigo" data-requerido="true" data-requerido-texto="Codigo" type="text" value="" size="10" maxlength="3">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Local:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboLocal",$vsqllocal,$local,'No'); ?>
        </td>
    </tr>														
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtDescripcion" id="txtDescripcion" data-requerido="true" data-requerido-texto="Descripcion" type="text" value="" size="70">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Capacidad:</strong>								
        </td>
        <td>
            <input name="txtCapacidad" id="txtCapacidad" data-requerido="true" data-requerido-texto="Descripcion" type="text" value="0" size="70">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Tipo:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipoAmbiente",$vsqltipoambiente,$tipoambiente,'Si'); ?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Observaci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtObservacion" type="text" value="" size="70">
        </td>
    </tr>								
    <tr>
        <td>
            <strong>Activo:</strong>								
        </td>
        <td>
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" checked>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="hidLocal" type="hidden" value="<?php echo $local;?>">											
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
