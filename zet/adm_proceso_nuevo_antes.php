<?php 
	$sede = $_GET["sede"];
	$vsqltipoproceso = "select tipoproceso, descripcion from adm_tipoproceso order by descripcion";	
	$vsqlsemestre = "select semestre, semestre from mae_semestre where activo=1 order by semestre desc";
	$vsqlprocesogeneral = "select procesogeneral, descripcion from adm_procesogeneral where activo=1 order by descripcion";
	$tipoproceso='01';
	$fecha = date('d/m/Y');
	#echo $fecha;
	#echo $vsqlsemestre;
	$titulo = 'Proceso';
	$sede = '01';
	$tipoproceso = '01';
	$semestre = '';
	$descripcion = '';
	$observacion = '';
	$resolucion = '';
	$fecharesolucion = date("d/m/Y");
	#$numeropreguntas = 0;
	#$preguntabuena = $row["preguntabuena"];
	#$preguntamala = $row["preguntamala"];
	$proceso = '';
	$procesogeneral = '';
	$presidente = '';
	$secretario = '';
	$vocal = '';
	$activo = 1;
	$vsqlsede = "select sede, descripcion from mae_sede order by descripcion";	
	$vsqltipoproceso = "select tipoproceso, descripcion from adm_tipoproceso order by descripcion";	
	$vsqlsemestre = "select semestre, semestre from mae_semestre where activo=1 order by semestre desc";
	$vsqlproceso = "select procesogeneral, descripcion from adm_procesogeneral order by descripcion";
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
	<form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="adm_proceso_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
          
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="Autom&aacute;tico">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Sede:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboSede",$vsqlsede,$sede,'Si'); ?>
        </div>
      </div><!--/form-group--> 
      
	  <div class="form-group">
        <label class="col-sm-3 control-label">Macro:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboProcesoGeneral",$vsqlproceso,$procesogeneral,'Si'); ?>
        </div>
      </div><!--/form-group--> 
      
	  <div class="form-group">
        <label class="col-sm-3 control-label">Semestre:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboSemestre",$vsqlsemestre,$semestre,'Si'); ?>
        </div>
      </div><!--/form-group--> 
      
 	  <div class="form-group">
        <label class="col-sm-3 control-label">Tipo:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboTipoProceso",$vsqltipoproceso,$tipoproceso,'Si'); ?>
        </div>
      </div><!--/form-group-->            

      <div class="form-group">
        <label class="col-sm-3 control-label">Descripci&oacute;n:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $descripcion;?>" name="txtDescripcion" id="txtDescripcion" data-requerido="true" data-requerido-texto="Descripcion">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Resoluci&oacute;n:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $resolucion;?>" name="txtResolucion" id="txtResolucion" data-requerido="true" data-requerido-texto="Resolucion">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Fecha:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $fecharesolucion;?>" name="txtFechaResolucion" id="txtFechaResolucion" data-requerido="true" data-requerido-texto="Fecha">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Observaci&oacute;n:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $observacion;?>" name="txtObservacion" id="txtObservacion">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Presidente:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $presidente;?>" name="txtPresidente" id="txtPresidente">
        </div>
      </div><!--/form-group--> 
      
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Secretario:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $secretario;?>" name="txtSecretario" id="txtSecretario">
        </div>
      </div><!--/form-group--> 
      
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Vocal:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $vocal;?>" name="txtVocal" id="txtVocal">
        </div>
      </div><!--/form-group--> 
      
      
	  <div class="form-group">
        <label class="col-sm-3 control-label">Activo:</label>
        <div class="col-sm-9">
        	<div class="checkbox">
            	<label>
                <input name="chkActivo" type="checkbox" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" value="<?php echo $activo?>" <?php if ($activo==1) {echo "checked";} ?>>
                <span class="custom-checkbox"></span>
                </label>
            </div>  
        </div>
      </div><!--/form-group--> 

      <div class="bottom">
        	<input name="codigo" type="hidden" value="">
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
      </div><!--/form-group-->
    </form>
  </div><!--/porlets-content-->
  </div>
</div>
<script>$('#cboSede').css('width','100%')</script>
<script>$('#cboSemestre').css('width','100%')</script>
<script>$('#cboProcesoGeneral').css('width','100%')</script>
<script>$('#cboTipoProceso').css('width','100%')</script>
<script>
function gEsCasillaActiva(idCasilla) {
    if (!document.getElementById(idCasilla)) {
        alert("El objeto no existe.\ngVerificaCasilla()");
    }
    return document.getElementById(idCasilla).checked ? "1" : "0";
}
</script>