<?php 
	$vsql = "call zyz_CAParametrosGenerales ('','',0,0,'',0,0,0,'C')";
	$vsqlsemestre = "select semestre, semestre from mae_semestre order by semestre desc";
	$vsqlsede = "select sede, descripcion from mae_sede where activo=1 order by descripcion";
	#echo $vsql;
	//sede    periodoacademico  periodonota   ciclo  certificado  colacion
	$rs = mysqli_query($cn,	$vsql);			
	$rsjk = mysqli_fetch_row($rs);	
	$sede = $rsjk[0];
	$semestre = $rsjk[1];
	$ciclo = $rsjk[2];
	$certificado = $rsjk[3];
	$colacion = $rsjk[4];
	$saltoboleta = $rsjk[5];
	$saltomatricula = $rsjk[6];
	$moodle = $rsjk[7];
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="mantenedorparametrosgeneralesgrabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>   
        	<!--data-atras="SI"-->          
            <a href="administracion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>">
            <i class="fa fa-mail-reply"></i> Regresar
            </a>
        </td>
    </tr>
</table>							
<table class="table">
    <tr>
        <td width="12%">
            <strong>Sede:</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboSede",$vsqlsede,$sede,'Si'); ?>
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Semestre:</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboSemestre",$vsqlsemestre,$semestre,'Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Ciclos Matricula:</strong>
        </td>
        <td>
            <input name="txtCiclo" type="text" value=<?php echo $ciclo; ?>>	
        </td>
    </tr>
    <tr>
        <td>
            <strong>Certificado:</strong>
        </td>
        <td>
            <input name="txtCertificado" type="text" value=<?php echo $certificado; ?>>	
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Colaci&oacute;n:</strong>
        </td>
        <td>
            <input name="txtColacion" type="text" value=<?php echo $colacion; ?>>	
        </td>
    </tr>
    <tr>
        <td>
            <strong>Salto Boleta:</strong>
        </td>
        <td>
            <input name="txtBoleta" type="text" value=<?php echo $saltoboleta; ?>>	
        </td>
    </tr>
    <tr>
        <td>
            <strong>Salto Matricula:</strong>
        </td>
        <td>
            <input name="txtMatricula" type="text" value=<?php echo $saltomatricula; ?>>	
        </td>
    </tr>
    <tr>
        <td>
            <strong>Moodle:</strong>								
        </td>
        <td>
            <input name="chkMoodle" type="checkbox" id="chkMoodle" onclick="this.value=gEsCasillaActiva(this.id);" value="<?php echo $moodle?>" <?php if ($moodle==1) {echo "checked";} ?>>
        </td>
    </tr>																																								
    <tr>
        <td align="center" colspan="2">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar"  class="btn btn-primary">
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