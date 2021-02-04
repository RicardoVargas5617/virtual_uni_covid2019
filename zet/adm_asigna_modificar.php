<?php 
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$tipoexamen = substr($codigo,4,2);
	$ambiente = substr($codigo,6);
	$vsqlambiente = "call zyz_CAProcesoAmbiente ('". $proceso . "','". $ambiente . "','". $tipoexamen . "',0,'1900-01-01','','','','','F')";
	
	
	#echo $vsqlambiente;
	
	$rs = mysqli_query($cn, $vsqlambiente);
	$num= mysqli_num_rows($rs); 	
	if ($num > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$capacidad =  $row["capacidad"];
			$supervisor =  $row["supervisor"];
			$aulavirtual =  $row["aulavirtual"];
		}
	
	$vsqlcapacidad = "select capacidad, capacidad from aca_capacidad where capacidad>=1 and capacidad<=50";
	$vsqlsupervisor = "select supervisor, nombrecompleto from admi_supervisor where activo=1 order by nombrecompleto";

	
	$nombreproceso = nombreproceso($proceso);
	$nombretipoexamenzet = nombrecanal($tipoexamen);
?>
<form name="form" method="post" id="frmcronmod" action="adm_asigna_grabarzet.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_asigna.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>&tipoexamen=<?php echo $tipoexamen?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>	
<table class="table">
    <tr>
        <td width="13%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $nombreproceso; ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>Tipo examen:</strong>
        </td>
        <td>
            <?php echo $nombretipoexamenzet; ?>
        </td>											
    </tr>    
    <tr>
        <td>
            <strong>Ambiente:</strong>
        </td>
        <td>
            <?php echo substr($ambiente,3,4); ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>Capacidad:</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboCapacidad",$vsqlcapacidad,$capacidad,'Si'); ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>Supervisor:</strong>
        </td>
        <td>
            <?php MostrarComboZet("cboSupervisor",$vsqlsupervisor,$supervisor,'Si'); ?>
        </td>											
    </tr>
	<tr>
        <td>
            <strong>Aula virtual:</strong>								
        </td>
        <td>
            <input name="txtAulaVirtual" id="txtAulaVirtual" type="text" value="<?php echo $aulavirtual; ?>" style="width: 60%" data-requerido="true" data-requerido-texto="Aula virtual">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input name="codigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="U">
            <input name="cmdGrabar" type="submit" value="Actualizar" class="btn btn-primary">										
        </td>											
    </tr>
</table>
</form>
