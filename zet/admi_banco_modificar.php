<?php
	require_once("zet_seg.php"); 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cn_zuz = conectar();
	mysqli_query($cn_zuz,"SET CHARACTER SET utf8");
	mysqli_query($cn_zuz,"SET NAMES utf8");	
	$codigo = base64_decode(base64_decode($_GET["clave"]));
	$vsql = "call zyz_Admi_Pregunta ('". $codigo . "','','','1','2','3','4','5','6','7','8','9',0,0,'',0,0,'','M')";	
	#echo $vsql;
	$rs = mysqli_query($cn_zuz,	$vsql);	
	$rsjk = mysqli_fetch_row($rs);		
	$banco = $rsjk[0];
	$tipo = $rsjk[1];
	$subtipo = $rsjk[2];
	$descripcion = $rsjk[3];
	$observacion = $rsjk[4];
	$claveA = $rsjk[5];
	$claveB = $rsjk[6];
	$claveC = $rsjk[7];
	$claveD = $rsjk[8];
	$claveE = $rsjk[9];
	$respuesta = $rsjk[10];
	$motivo = $rsjk[11];
	$imagen = $rsjk[12];
	$activo = $rsjk[13];
	$canal = $rsjk[14];
	$contador = 0;
	
	$ver=$tipo.$subtipo;
	#echo $ver;
	
	$nombretiposubtipo = nombretiposubtipo($ver);
	$vsqlrespuesta = "select valor, descripcion from admi_valor order by valor";
	$vsqlcanal = "select canal, descripcion from admi_canal order by canal desc";
?>
<form name="form" method="post" id="frmcronmod" action="admi_banco_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<!-- onsubmit="grabar(this.id);return false;"-->
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_banco.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&subtipo=<?php echo $ver?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>							
<table class="table">
    <tr>
        <td width="13%">
            <strong>Tipo:</strong>								
        </td>
        <td>
        	<strong>
            <?php echo $nombretiposubtipo; ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <?php echo $banco;?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Canal</strong>								
        </td>
        <td>
			<?php MostrarComboZet("cboCanal",$vsqlcanal,$canal,'Si'); ?>
        </td>
    </tr>   												
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td>
            <textarea name="content" cols="12" rows="12" id="editor" class="ckeditor">
			<?php echo $descripcion; ?>
            </textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: A</strong>								
        </td>
        <td>
            <textarea name="txtClaveA" cols="36" rows="2" id="txtClaveA"  class="ckeditor"><?php echo $claveA; ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: B</strong>								
        </td>
        <td>
            <textarea name="txtClaveB" cols="36" rows="2" id="txtClaveB"  class="ckeditor"><?php echo $claveB; ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: C</strong>								
        </td>
        <td>
            <textarea name="txtClaveC" cols="36" rows="2" id="txtClaveC"  class="ckeditor"><?php echo $claveC; ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: D</strong>								
        </td>
        <td>
            <textarea name="txtClaveD" cols="36" rows="2" id="txtClaveD"  class="ckeditor"><?php echo $claveD; ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: E</strong>								
        </td>
        <td>
            <textarea name="txtClaveE" cols="36" rows="2" id="txtClaveE"  class="ckeditor"><?php echo $claveE; ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Respuesta</strong>								
        </td>
        <td>
			<?php MostrarComboZet("cboRespuesta",$vsqlrespuesta,$respuesta,'Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Observaci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtObservacion" id="txtObservacion" type="text" value="<?php echo $observacion?>" size="100">
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>
            Imagen:
            </strong>        
        </td>
        <td>     
        	<?php 
            mostrarfoto_pregunta($banco);
            ?>	
        </td>    
    </tr>
    <tr>
        <td>
            <strong>Activo:</strong>								
        </td>
        <td>
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="<?php echo $activo?>"  <?php if ($activo==1) {echo "checked";} ?>>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="banco" type="hidden" value="<?php echo $codigo;?>">	
            <input name="hidTipo" type="hidden" value="<?php echo $ver;?>">											
            <input name="txtTipo" type="hidden" value="U">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
</table>
</form>
<script>$('#cboSubTipo').css('width','100%')</script>
<script>
function gEsCasillaActiva(idCasilla) {
    if (!document.getElementById(idCasilla)) {
        alert("El objeto no existe.\ngVerificaCasilla()");
    }
    return document.getElementById(idCasilla).checked ? "1" : "0";
}
</script>

