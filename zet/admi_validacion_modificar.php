<?php 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$clave = base64_decode(base64_decode($_GET["clave"])); 
	$vsql = "call zyz_Admi_GrabarPre ('". $clave . "','','','','','','','','',0,0,'M')";	
	#echo $vsql;

	$rs = mysqli_query($cn,	$vsql);	
	$rsjk = mysqli_fetch_row($rs);		
	$preinscripcion = $rsjk[0];
	$apellidopaterno = $rsjk[1];
	$apellidomaterno = $rsjk[2];
	$nombres = $rsjk[3];
	$email = $rsjk[5];
	$celular = $rsjk[6];
	$clavel = $rsjk[7];
	$validar = $rsjk[8];
	$dni = $rsjk[9];
	$observacion = $rsjk[10];
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="admi_validacion_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_validacion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="15%">
            <strong>C&oacute;digo</strong>
        </td>
        <td>
            <?php echo $dni ?>
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Apellido Paterno</strong>								
        </td>
        <td>
            <input name="txtApellidoPaterno" id="txtApellidoPaterno" data-requerido="true" data-requerido-texto="Apellido Paterno" type="text" value="<?php echo $apellidopaterno ?>" size="70">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Apellido Materno</strong>								
        </td>
        <td>
            <input name="txtApellidoMaterno" id="txtApellidoMaterno" data-requerido="true" data-requerido-texto="Apellido Materno" type="text" value="<?php echo $apellidomaterno ?>" size="70">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Nombres</strong>								
        </td>
        <td>
            <input name="txtNombres" id="txtNombres" data-requerido="true" data-requerido-texto="Nombres" type="text" value="<?php echo $nombres ?>" size="70">
        </td>
    </tr>
	<tr>
        <td>
            <strong>Email</strong>								
        </td>
        <td>
            <input name="txtEmail" id="txtEmail" data-requerido="true" data-requerido-texto="Email" type="text" value="<?php echo $email ?>" size="70">
        </td>
    </tr>  
    <tr>
        <td>
            <strong>Celular</strong>								
        </td>
        <td>
            <input name="txtCelular" id="txtCelular" data-requerido="true" data-requerido-texto="Celular" type="text" value="<?php echo $celular ?>" size="70">
        </td>
    </tr>  
    <tr>
        <td>
            <strong>Clave</strong>								
        </td>
        <td>
            <input name="txtClave" id="txtClave" data-requerido="true" data-requerido-texto="Clave" type="text" value="<?php echo $clavel ?>" size="70">
        </td>
    </tr> 
    <tr>
        <td>
            <strong>Observaci&oacute;n</strong>								
        </td>
        <td>
            <input name="txtObservacion" id="txtObservacion"  type="text" value="<?php echo $observacion ?>" size="70">
        </td>
    </tr>   																																																				
    <tr>
        <td>
            <strong>Voucher</strong>								
        </td>
        <td>
            <?php 
            mostrarfoto_voucher($dni);
            ?>	
        </td>
    </tr>
    <tr>
        <td>
            <strong>Postulante</strong>								
        </td>
        <td>
            <?php 
            mostrarfoto_postulante($dni);
            ?>	
        </td>
    </tr>   
    <tr>
        <td>
            <strong>Dni</strong>								
        </td>
        <td>
            <?php 
            mostrarfoto_dni($dni);
            ?>	
        </td>
    </tr>    
    <tr>
        <td>
            <strong>Activar</strong>								
        </td>
        <td>
            <input name="chkActivo" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="1" <?php if ($validar==1) {echo "checked";} ?>>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="hidCodigo" type="hidden" value="<?php echo $clave;?>">
            <input name="dni" type="hidden" value="<?php echo $dni;?>">
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
								