<?php 
	require_once("zet_seg.php");
	$paginaactual = $_GET["paginaactual"];
	$codigo = $_GET["codigo"];
?>
<form name="form" method="post" id="frmcronmod" action="mantenedormaestrograbar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>"  onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_maestro.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&codigo=<?php echo $codigo;?>&paginaactual=<?php echo $paginaactual?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>							
<table class="table">
    <tr>
        <td width="12%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <input name="hidClave" id="hidClave" type="hidden" value="" lengthchar="2" size="3">            
            << Autom&aacute;tico >> 
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtDescripcion" id="hidClave" data-requerido="true" data-requerido-texto="Descripcion" type="text" value="" size="70">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Activo:</strong>								
        </td>
        <td>
            <input name="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" id="chkActivo" type="checkbox" value="1" checked>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="hidCodigo" type="hidden" value="<?php echo $codigo;?>">
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