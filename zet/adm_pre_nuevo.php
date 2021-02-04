<?php 
	$proceso = $_GET["proceso"];
	$departamento = "09";
	$provincia = "07";
	$distrito = "01";
	$vsqlescuelamodalidad = "call zyz_CAMantenedorVacante ('". $proceso . "', '','',0,1,'D')";
	$vsqltipocolegio = "select tipocolegio, descripcion from adm_tipocolegio order by descripcion";	
	$vsqltipodocumento = "select tipodocumento, descripcion from mae_tipodocumento where activo=1 order by descripcion";
	$vsqlsexo = "select sexo, descripcion from adm_sexo where activo=1 order by descripcion";
	$tipodocumento='01';
	$sexo='M';
?>
<form  name="form" method="post" id="frmcronmod" action="adm_pre_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_pre.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="15%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $proceso?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Escuela - Modalidad:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboEscuelaModalidad",$vsqlescuelamodalidad,'','Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Apellido paterno:</strong>								
        </td>
        <td>
            <input name="txtApellidoPaterno" id="txtApellidoPaterno" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Apellido Paterno">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Apellido materno:</strong>								
        </td>
        <td>
            <input name="txtApellidoMaterno" id="txtApellidoMaterno" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Apellido Materno">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Nombres:</strong>								
        </td>
        <td>
            <input name="txtNombre" id="txtNombre" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Nombres">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Fec. Nacimiento:</strong>								
        </td>
        <td>
            <input name="txtFechaNacimiento" id="txtFechaNacimiento" type="text" value="" style="width: 20%" data-requerido="true" data-requerido-texto="Fecha Nacimiento">
        </td>
    </tr>
    <tr>
        <td>
            <strong>DNI:</strong>								
        </td>
        <td>
            <input name="txtNumeroDocumento" id="txtNumeroDocumento" type="text" value="" style="width: 15%" data-requerido="true" data-requerido-texto="Nro. Documento" maxlength="8">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Sexo:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboSexo",$vsqlsexo,$sexo,'Si'); ?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Celular/Fijo:</strong>								
        </td>
        <td>
            <input name="txtTelefono" id="txtTelefono" type="text" value="" style="width: 60%" data-requerido-texto="Celular">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Email:</strong>								
        </td>
        <td>
            <input name="txtEmail" id="txtEmail" type="text" value="" style="width: 60%" data-requerido-texto="Email">
        </td>
    </tr>		
    <tr>
        <td>
            <strong>Colegio procedencia:</strong>								
        </td>
        <td>
            <input name="txtColegio" id="txtColegio" type="text" value="" style="width: 85%" data-requerido="true" data-requerido-texto="Colegio">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Recibo Pago:</strong>								
        </td>
        <td>
            <input name="txtReciboPago" id="txtReciboPago" type="text" value="" style="width: 15%" data-requerido="true" data-requerido-texto="Recibo Pago" maxlength="16">
        </td>
    </tr>																																				
    <tr>
        <td align="center" colspan="2">
            <input name="proceso" type="hidden" value="<?php echo $proceso;?>">	
            <input name="postulante" type="hidden" value="">								
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
</table>
</form>
<script>$('#cboEscuelaModalidad').css('width','100%')</script>
