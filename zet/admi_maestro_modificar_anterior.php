<?php 
	require_once("zet_seg.php");
	$codigo = $_GET["codigo"];
	$clave = $_GET["clave"];
	$paginaactual = $_GET["paginaactual"];
	$vsql = "call zyz_Man_Maestro ('". $codigo . "','M','". $clave . "','',0)";		
	//echo $vsql;	
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$clave = $row["codigo"];
			$descripcion = $row["descripcion"];
			$activo = $row["activo"];
			$titulo = $row["titulo"];
			mysqli_data_seek($rs,0);
		}	
	$contador = 0;

?>
<form  name="form" method="post" id="frmcronmod" action="admi_maestro_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>
            
            <a data-atras="SI" href="admi_maestro.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&codigo=<?php echo $codigo;?>&paginaactual=<?php echo $paginaactual?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="12%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <?php echo $clave ?>
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtDescripcion" id="txtDescripcion" data-requerido="true" data-requerido-texto="Descripcion" type="text" value="<?php echo $descripcion ?>" size="70">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Activo:</strong>								
        </td>
        <td>
            <input name="chkActivo" type="checkbox" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" value="<?php echo $activo?>" <?php if ($activo==1) {echo "checked";} ?>>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="hidCodigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="hidClave" type="hidden" value="<?php echo $clave;?>">
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
