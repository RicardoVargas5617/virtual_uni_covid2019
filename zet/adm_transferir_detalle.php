<?php	
	$cn = conectar();	
	$cn_vacante = conectar();
	if (isset($_GET['codigo'])) 
		{
			$proceso = base64_decode(base64_decode($_GET["codigo"]));
			
			$vsql_vacante = "call zyz_MantenedorProceso ('". $proceso . "', '','','','','','','1900-01-01',0,0,0,1,'','','','','F')";
			#echo $vsql_vacante;			
			$rs_vacante = mysqli_query($cn_vacante, $vsql_vacante);
			$num= mysqli_num_rows($rs_vacante); 	
			if ($num > 0)
				{
					$row_vacante = mysqli_fetch_array($rs_vacante, MYSQLI_ASSOC);
					$procesonuevo =  $row_vacante["proceso"];
				}
		}
	#echo $proceso;
	$nombreproceso = nombreproceso($proceso);
	$contador = 0;
	$vsqlproceso = "call zyz_MantenedorProceso ('". $proceso . "', '','','','','','','1900-01-01',0,0,0,1,'','','','','G')";		
?>
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_transferir.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<div class="alert alert-success">
	<span class="semi-bold">Aseg&uacute;rese que los valores transferencia sean correctos. Los cambios son irreversibles.</span>
</div>	
<form name="form" method="post" id="frmcronmod" action="adm_transferir_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table class="table">
	<tr>
    	<td width="12%">
        	<strong>Proceso:</strong>
      	</td>
      	<td>
        	<?php echo $nombreproceso; ?>
      	</td>																																								
  	</tr>	
 	<tr>
    	<td>
        	<strong>Transferir a:</strong>
      	</td>
      	<td>
        	<?php MostrarComboZet("cboProcesoNuevo",$vsqlproceso,$procesonuevo,'Si'); ?>
      	</td>																																								
  	</tr>			
    <tr>
    	<td colspan="2" align="center">
        	<input name="proceso" type="hidden" value="<?php echo base64_encode(base64_encode($proceso));?>">
        	<input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>
    </tr>																
</table>	
</form>
<script>$('#cboProcesoNuevo').css('width','100%')</script>