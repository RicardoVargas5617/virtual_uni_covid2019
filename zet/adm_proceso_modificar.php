<?php 
	require_once("zet_seg.php");
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$codigo = $_GET["codigo"];
	$vsqlsede = "select sede, descripcion from mae_sede order by descripcion";	
	$vsqltipoproceso = "select tipoproceso, descripcion from adm_tipoproceso order by descripcion";	
	$vsqlsemestre = "select semestre, semestre from mae_semestre where activo=1 order by semestre desc";
	$vsqlproceso = "select procesogeneral, descripcion from adm_procesogeneral order by descripcion";

	$vsql = "call zyz_MantenedorProceso ('". $codigo . "', '','','','','','','1900-01-01',0,0,0,1,'','','','','M')";	
	#echo $vsql;	
	$rs = mysqli_query($cnzet, $vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			#$codigo = $row["codigo"];
			$sede = $row["sede"];
			$tipoproceso = $row["tipoproceso"];
			$semestre = $row["semestre"];
			$descripcion = $row["descripcion"];
			$observacion = $row["observacion"];
			$resolucion = $row["resolucion"];
			$fecharesolucion = $row["fecharesolucion"];
			$numeropreguntas = $row["numeropreguntas"];
			$preguntabuena = $row["preguntabuena"];
			$preguntamala = $row["preguntamala"];
			$proceso = $row["proceso"];
			$procesogeneral = $row["procesogeneral"];
			$presidente = $row["presidente"];
			$secretario = $row["secretario"];
			$vocal = $row["vocal"];
			$activo = $row["activo"];
			mysqli_data_seek($rs,0);
		}	
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
	<form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="adm_proceso_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
          
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="<?php echo $codigo; ?>">
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
        <label class="col-sm-3 control-label">Pre. Buena:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $preguntabuena;?>" name="txtPreguntaBuena" id="txtPreguntaBuena" data-requerido="true" data-requerido-texto="Pregunta Buena">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Pre. Mala:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $preguntamala;?>" name="txtPreguntaMala" id="txtPreguntaMala" data-requerido="true" data-requerido-texto="Pregunta Mala">
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
        	<input name="codigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
      </div><!--/form-group-->
    </form>
  </div><!--/porlets-content-->
  </div>
</div>
<?php mysqli_close($cn);?>
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
