<?php 
	require_once("zet_seg.php");
	$vsqlperfil = "select perfil, nombre from men_perfil order by nombre ";	
	$codigo = $_GET["codigo"];
	$proceso = substr($codigo,0,4);
	$canal = substr($codigo,4,2);
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_Admi_Estructura ('". $proceso . "','". $canal . "','','',0,0,'D')";	
	#echo $vsql;
	//$rs = mysqli_query($cn,	$vsql);		
	$nombrecanal = nombrecanal($canal);	
	$contador = 0;
?>
<form name="form" method="post" id="frmcronmod" action="admi_estructura_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_estructura.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&codigo=<?php echo $codigo?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>	
<table class="table">
    <tr>
        <td width="8%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $nombreproceso; ?>
        </td>											
    </tr>
    <tr>
        <td width="8%">
            <strong>Canal:</strong>
        </td>
        <td>
            <?php echo $nombrecanal; ?>
        </td>											
    </tr>    
    <tr>
        <td>
            <strong>Tipo:</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboPregunta",$vsql,'','Si'); ?>
        </td>											
    </tr>
	<tr>
        <td>
            <strong>Preguntas:</strong>
        </td>
        <td>
    		<input name="txtPregunta" type="text" value="" maxlength="2">
        </td>											
    </tr>
	<tr>
        <td>
            <strong>Orden:</strong>
        </td>
        <td>
            <input name="txtOrden" type="text" value=""  maxlength="2">
        </td>											
    </tr>   
    <tr>
        <td colspan="2" align="center">
            <input name="hidCodigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Agregar" class="btn btn-primary">										
        </td>											
    </tr>
</table>
</form>
<script>$('#cboPregunta').css('width','100%')</script>
