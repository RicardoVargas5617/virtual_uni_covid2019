<?php 
	require_once("zet_seg.php");
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$codigo = $_GET["codigo"];
	$vsql = "call zyz_MantenedorProceso_Calendario ('". $codigo . "', '1900-01-01','1900-01-01','','C')";	
	#echo $vsql;	
	$rs = mysqli_query($cnzet, $vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$fechainicio = $row["fechainicio"];
			$horainicio = $row["horainicio"];
			$fechafin = $row["fechafin"];
			$horafin = $row["horafin"];
			$mensaje = $row["mensaje"];
			mysqli_data_seek($rs,0);
		}	
	$nombreproceso = nombreproceso($codigo);
	$contador = 0;
	$titulo = 'Proceso';
?>
<div class="row">
  <div class="block-web">
  <div class="header">
  	<div class="actions"> 
        <a data-atras="SI" href="adm_proceso.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i>       
    	</a>
    </div>
    <h5 class="content-header"><?php echo $titulo;?></h5>
  </div>
  <div class="porlets-content">
	<form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="adm_proceso_calendario_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
          
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="<?php echo $codigo.'&nbsp;&nbsp;'.$nombreproceso; ?>">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Fecha Inicio:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $fechainicio;?>" name="txtFechaInicio" id="txtFechaInicio" data-requerido="true" data-requerido-texto="Fecha Inicio" maxlength="10">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Hora Inicio:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $horainicio;?>" name="txtHoraInicio" id="txtHoraInicio" data-requerido="true" data-requerido-texto="Hora Inicio" maxlength="5">
        </div>
      </div><!--/form-group--> 
      
	  <div class="form-group">
        <label class="col-sm-3 control-label">Fecha Fin:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $fechafin;?>" name="txtFechaFin" id="txtFechaFin" data-requerido="true" data-requerido-texto="Fecha Fin"  maxlength="10">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Hora Fin:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $horafin;?>" name="txtHoraFin" id="txtHoraFin" data-requerido="true" data-requerido-texto="Hora fin" maxlength="5">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Mensaje:</label>
        <div class="col-sm-9">
        <textarea name="txtMensaje" cols="36" rows="2" id="txtMensaje"  class="ckeditor"><?php echo $mensaje; ?></textarea>
        </div>
      </div><!--/form-group--> 

      <div class="bottom">
        	<input name="codigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
      </div><!--/form-group-->
    </form>
  </div><!--/porlets-content-->
  </div>
</div>
<?php mysqli_close($cn);?>
</script>
