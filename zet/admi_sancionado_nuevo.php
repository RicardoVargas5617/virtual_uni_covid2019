<?php 
	$proceso = base64_decode(base64_decode($_GET["proceso"]));
	$vsqlpostulante = "call zoz_Admi_Sancionado ('". $proceso . "', '','', '','','S')";
	#echo $vsqlpostulante;
?>
<form name="form" method="post" id="frmcronmod" action="admi_sancionado_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>"  onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_sancionado.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&proceso= <?php echo base64_encode(base64_encode($proceso))?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>	
<table class="table">
    <tr>
        <td width="8%">
            <strong>Postulante</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboPostulante",$vsqlpostulante,'','Si'); ?>
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Observaci&oacute;n</strong>								
        </td>
        <td>
            <input name="txtObservacion" id="txtObservacion" data-requerido="true" data-requerido-texto="Observacion" type="text" value="" style="width:100%">
        </td>
    </tr>    																													
    <tr>
        <td align="center" colspan="2">
            <input name="proceso" type="hidden" value="<?php echo base64_encode(base64_encode($proceso));?>">											
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>
</table>
</form>
<script>$('#cboPostulante').css('width','100%')</script>
