<?php 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cnzet = conectar();
	$codigo = $_GET["clave"];
	$proceso = substr($codigo,0,4);
	$tipito = substr($codigo,4,1);
	$postulante = substr($codigo,5,7);
	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','". $postulante . "', 'I','','C')";
	#echo $vsql;
	$rs = mysqli_query($cnzet, $vsql);	
	$rsjk = mysqli_fetch_row($rs);		
	$dni = $rsjk[3];
	$nombrecompleto = $rsjk[4];
	$escuela = $rsjk[5];
	$modalidad = $rsjk[6];
	$dj = $rsjk[9];
	$validado = $rsjk[10];
	$doc = $rsjk[11];
	$contador = 0;
?>
<form  name="form" method="post" id="frmcronmod" action="adm_constancia_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_constancia.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>">
            <i class="fa fa-mail-reply"></i> 
            Regresar
            </a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="15%">
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <?php echo $dni;?>
        </td>
    </tr>													
    <tr>
        <td>
            <strong>Apellidos y nombres:</strong>								
        </td>
        <td>
            <?php echo $nombrecompleto ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Escuela:</strong>								
        </td>
        <td>
            <?php echo $escuela ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Modalidad:</strong>								
        </td>
        <td>
            <?php echo $modalidad ?>
        </td>
    </tr> 
    <tr>
        <td>
            <strong>D. Jurada:</strong>								
        </td>
        <td>
        	<?php
             if ($dj==1)
					{
                        echo '<span class="blue_bg bg_space">';
                        echo 'Aceptada';
                        echo '</span>';
                    }
					else
					{
                        echo '<span class="red_bg bg_space">';
                        echo 'No Aceptada';
                        echo '</span>';
                    }
			?>
        </td>
    </tr>   
    <tr>
        <td>
            <strong>Foto voucher:</strong>								
        </td>
        <td>
            <?php
            mostrarfoto_ing_voucher($dni);
			?>
        </td>
    </tr> 
    <tr>
        <td>
            <strong>Foto firma:</strong>								
        </td>
        <td>
            <?php
            mostrarfoto_ing_firma($dni);
			?>
        </td>
    </tr> 
    <tr>
        <td>
            <strong>Foto firma ap:</strong>								
        </td>
        <td>
            <?php
            mostrarfoto_ing_apoderado($dni);
			?>
        </td>
    </tr>  										
    <tr>
        <td>
            <strong>Documentos:</strong>								
        </td>
        <td>
            <input name="chkDoc" id="chkDoc" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="<?php echo $doc; ?>" <?php if ($doc==1) {echo "checked";} ?>>
        </td>
    </tr>   
    <tr>
        <td>
            <strong>Validado:</strong>								
        </td>
        <td>
            <input name="chkValidado" id="chkValidado" onclick="this.value=gEsCasillaActiva(this.id);" type="checkbox" value="<?php echo $validado; ?>" <?php if ($validado==1) {echo "checked";} ?>>
        </td>
    </tr>																																	
    <tr>
        <td align="center" colspan="2">
            <input name="postulante" type="hidden" value="<?php echo $postulante;?>">											
            <input name="dni" type="hidden" value="<?php echo $dni;?>">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
    <?php mysqli_close($cnzet);?>
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