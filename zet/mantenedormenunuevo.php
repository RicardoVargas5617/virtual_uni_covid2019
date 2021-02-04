<?php 
	$dominio = $_GET["dominio"];
	$vsqldominio = "select dominio, nombre from men_dominio where activo=1 order by nombre";
?>
<form name="form" method="post" id="frmcronmod" action="mantenedormenugrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>"  onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="mantenedormenu.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&dominio=<?php echo $dominio?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>							
<table class="table">
    <tr>
        <td width="9%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <input name="hidCodigo" id="hidCodigo" type="hidden" value="" lengthchar="2" size="3">            
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
            <strong>Dominio:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboDominio",$vsqldominio,$dominio,'No'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Orden:</strong>
        </td>
        <td>
            <input name="txtOrden" id="txtOrden" data-requerido="true" data-requerido-texto="Orden" type="text" value="" size="70" maxlength="2">
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
            <input name="hidDominio" type="hidden" value="<?php echo $dominio;?>">											
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
