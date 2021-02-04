<?php 
	require_once("zet_seg.php");
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$subtipo = $_GET["subtipo"];
	$vsqlcanal = "select canal, descripcion from admi_canal order by canal desc";
	$vsqlsubtipo = "select concat(s.tipo,s.subtipo) as codigo, concat(t.descripcion, ' ----> ', s.descripcion) as descripcion from admi_tipo t inner join admi_subtipo s on t.tipo=s.tipo order by t.descripcion, s.descripcion ";	
	$nombretiposubtipo = nombretiposubtipo($subtipo);
	$vsqlrespuesta = "select valor, descripcion from admi_valor order by valor";
	$imagen=0;
	$activo=1;
?>
<form name="form" method="post" id="frmcronmod" action="admi_banco_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<!-- onsubmit="grabar(this.id);return false;"-->
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_banco.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&subtipo=<?php echo $subtipo?>"><i class="fa fa-mail-reply"></i> Regresar</a>
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
            <input name="hidCodigo" id="hidCodigo" type="hidden" value="" lengthchar="2" size="3">         
            << Autom&aacute;tico >> 
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Canal</strong>								
        </td>
        <td>
			<?php MostrarComboZet("cboCanal",$vsqlcanal,'X','Si'); ?>
        </td>
    </tr>    												
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td><textarea name="content" cols="12" rows="3" id="editor" class="ckeditor"></textarea></td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: A</strong>								
        </td>
        <td>
            <textarea name="txtClaveA" cols="36" rows="2" id="txtClaveA" class="ckeditor"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: B</strong>								
        </td>
        <td>
            <textarea name="txtClaveB" cols="36" rows="2" id="txtClaveB" class="ckeditor"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: C</strong>								
        </td>
        <td>
            <textarea name="txtClaveC" cols="36" rows="2" id="txtClaveC" class="ckeditor"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: D</strong>								
        </td>
        <td>
            <textarea name="txtClaveD" cols="36" rows="2" id="txtClaveD" class="ckeditor"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Opci&oacute;n: E</strong>								
        </td>
        <td>
            <textarea name="txtClaveE" cols="36" rows="2" id="txtClaveE"  class="ckeditor"></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Respuesta</strong>								
        </td>
        <td>
			<?php MostrarComboZet("cboRespuesta",$vsqlrespuesta,'A','Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Observaci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtObservacion" id="txtObservacion" type="text" value="" size="100">
        </td>
    </tr>
    <!--
    <tr>
        <td>
            <strong>Imagen:</strong>								
        </td>
        <td>
            <input name="chkImagen" id="chkImagen" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" checked>
        </td>
    </tr>

    <tr>
    	<td>
        	<strong>
            Imagen:
            </strong>        
        </td>
        <td>     
        	<input type='file' id="imgInp" name="imgInp" class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Seleccione foto voucher" aria-describedby="imgInp-message">
			<img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" width="150" height="150px" />
        </td>    
    </tr>
    -->
    <tr>
        <td>
            <strong>Activo:</strong>								
        </td>
        <td>
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" checked="checked">
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="banco" type="hidden" value="">	
            <input name="hidTipo" type="hidden" value="<?php echo $subtipo;?>">											
            <input name="txtTipo" type="hidden" value="N">
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
<script>
function readImage (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah').attr('src', e.target.result); // Renderizamos la imagen
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    readImage(this);
  });
</script>
