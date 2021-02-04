<?php 
	$cn_zet = conectar();
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");
	$codigo = $_GET["clave"];
	$tipoadmision = substr($codigo,0,2);
	$subtipo = substr($codigo,2,2);
	$vsql = "call zyz_Admi_SubTipo ('". $tipoadmision . "','". $subtipo . "','',0,'M')";
	#echo $vsql;
	$rs = mysqli_query($cn_zet, $vsql);	
	$rsjk = mysqli_fetch_row($rs);		
	$descripcion = $rsjk[2];
	$activo = $rsjk[3];
	$contador = 0;			
	$vsqltipo = "select tipo, descripcion from admi_tipo order by descripcion ";
?>
<form name="form" method="post" id="frmcronmod" action="admi_subtipo_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<!-- onsubmit="grabar(this.id);return false;"-->
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_subtipo.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&tipo=<?php echo $tipoadmision?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>							
<table class="table">
    <tr>
        <td width="13%">
            <strong>Tipo:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipo",$vsqltipo,$tipoadmision,'No'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <input name="hidCodigo" id="hidCodigo" type="hidden" value="<?php echo $subtipo?>" lengthchar="2" size="3">         
            <?php echo $subtipo;?>
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtDescripcion" id="txtDescripcion" data-requerido="true" data-requerido-texto="Descripcion" type="text" value="<?php echo $descripcion; ?>" size="70">
        </td>
    </tr>    
    <tr>
        <td>
            <strong>Activo:</strong>								
        </td>
        <td>
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" <?php if ($activo==1) {echo "checked";} ?>>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="hidTipo" type="hidden" value="<?php echo $tipoadmision;?>">											
            <input name="txtTipo" type="hidden" value="A">
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
