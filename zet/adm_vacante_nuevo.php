<?php 
	$proceso = $_GET["proceso"];
	$vsqlescuela = "select estructura, descripcion from mae_estructura where activo=1 order by descripcion";	
	$vsqlmodalidadadmision = "select modalidadadmision, descripcion from adm_modalidadadmision where activo=1 order by descripcion";
	$modalidad='01';
?>
<form  name="form" method="post" id="frmcronmod" action="adm_vacante_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_vacante.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="12%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $proceso?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Escuela:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboEscuela",$vsqlescuela,'','Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Modalidad:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboModalidadadmision",$vsqlmodalidadadmision,$modalidad,'Si'); ?>
        </td>
    </tr>															
    <tr>
        <td>
            <strong>Vacantes:</strong>								
        </td>
        <td>
            <input name="txtVacante" id="txtVacante" type="text" value="0" style="width: 20%">
        </td>
    </tr>	   
    <!--
    <tr>
        <td>
            <strong>Puntaje Minimo:</strong>								
        </td>
        <td>
            <input name="txtPuntaje" id="txtPuntaje" type="text" value="0" style="width: 20%">
        </td>
    </tr>	
    -->																																				
    <tr>
        <td align="center" colspan="2">
            <input name="proceso" type="hidden" value="<?php echo $proceso;?>">									
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
</table>
</form>
<script>$('#cboEscuela').css('width','70%')</script>
<script>$('#cboModalidadadmision').css('width','70%')</script>