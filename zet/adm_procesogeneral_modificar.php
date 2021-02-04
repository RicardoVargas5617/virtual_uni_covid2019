<?php 
	$codigo = $_GET["clave"];
	$vsql = "call zyz_MantenedorProcesoGeneral ('". $codigo . "','','',0,'1900-01-01','','M')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$rsjk = mysqli_fetch_row($rs);	
	$descripcion = $rsjk[1];
	$semestre = $rsjk[2];
	$activo = $rsjk[3];
	$contador = 0;
	$titulo = 'Macro proceso';
	$vsqlsemestre = "select semestre, semestre from mae_semestre order by semestre desc";
?>
<div class="row">
  <div class="block-web">
  <div class="header">
  	<div class="actions"> 
        <a data-atras="SI" href="adm_procesogeneral.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i>       
    	</a>
    </div>
    <h5 class="content-header"><?php echo $titulo;?></h5>
  </div>
  <div class="porlets-content">
	<form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="adm_procesogeneral_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
          
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="<?php echo $codigo; ?>">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Descripci&oacute;n:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $descripcion;?>" name="txtDescripcion" id="txtDescripcion" data-requerido="true" data-requerido-texto="Descripcion">
        </div>
      </div><!--/form-group--> 
      
	  <div class="form-group">
        <label class="col-sm-3 control-label">Semestre:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboSemestre",$vsqlsemestre,$semestre,'Si'); ?>
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
        	<input name="hidCodigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
      </div><!--/form-group-->
    </form>
  </div><!--/porlets-content-->
  </div>
</div>

<script>
function gEsCasillaActiva(idCasilla) {
    if (!document.getElementById(idCasilla)) {
        alert("El objeto no existe.\ngVerificaCasilla()");
    }
    return document.getElementById(idCasilla).checked ? "1" : "0";
}
</script>